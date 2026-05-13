<?php

namespace App\Http\Controllers;

use App\Models\CalculatorLead;
use App\Models\ContactSetting;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class CostBenchmarkController extends Controller
{
    // BUG #5 FIX — Sea FCL corrected: $2,213/40ft FEU ÷ 26,000 kg ÷ 1.10 USD/EUR + surcharges = €0.085
    // Source: Drewry World Container Index 2025, 40ft FEU India–Europe
    private const FREIGHT_RATES = [
        'Sea'    => 0.085,
        'SeaLCL' => 0.27,
        'Air'    => 5.00,
        'Road'   => 0.34,
        'source' => 'Drewry WCI 2025 (40ft FEU ÷ 26,000 kg + surcharges)',
    ];

    // BCD, IGST, SWS — verified per CBIC Budget 2025-26 notifications
    // BUG #6 FIX — corrected 3004 (Pharma: 5% not 10%), 9018 (Med Devices: 5% not 7.5%), 2710 (Chemicals: 10% not 2.5%)
    private const DUTY_TABLE = [
        '8708' => ['bcd_pct' => 7.5,  'igst_pct' => 18, 'sws_pct' => 0.75, 'note' => 'Auto parts — CBIC 2025-26'],
        '8467' => ['bcd_pct' => 7.5,  'igst_pct' => 18, 'sws_pct' => 0.75, 'note' => 'Industrial machinery — CBIC 2025-26'],
        '8541' => ['bcd_pct' => 0.0,  'igst_pct' => 18, 'sws_pct' => 0.00, 'note' => 'Semiconductors/electronics — 0% BCD'],
        '6203' => ['bcd_pct' => 20.0, 'igst_pct' => 12, 'sws_pct' => 2.00, 'note' => 'Textiles/clothing — CBIC 2025-26'],
        '3004' => ['bcd_pct' => 5.0,  'igst_pct' => 12, 'sws_pct' => 0.50, 'note' => 'Pharmaceuticals — 5% BCD CBIC 2025-26'],
        '9031' => ['bcd_pct' => 7.5,  'igst_pct' => 18, 'sws_pct' => 0.75, 'note' => 'Precision instruments — CBIC 2025-26'],
        '2106' => ['bcd_pct' => 30.0, 'igst_pct' => 18, 'sws_pct' => 3.00, 'note' => 'Food preparations — verify per sub-heading, varies 0-100%'],
        '9018' => ['bcd_pct' => 5.0,  'igst_pct' => 12, 'sws_pct' => 0.50, 'note' => 'Medical devices — 5% BCD CBIC 2025-26'],
        '2710' => ['bcd_pct' => 10.0, 'igst_pct' => 18, 'sws_pct' => 1.00, 'note' => 'Chemicals/petroleum — CBIC 2025-26'],
        '3926' => ['bcd_pct' => 10.0, 'igst_pct' => 18, 'sws_pct' => 1.00, 'note' => 'Plastics/rubber articles — CBIC 2025-26'],
        '7228' => ['bcd_pct' => 15.0, 'igst_pct' => 18, 'sws_pct' => 1.50, 'note' => 'Steel/special alloy — CBIC 2025-26'],
    ];

    // Cached for 30 minutes — avoids hammering free-tier APIs on every page load
    private const FX_CACHE_TTL   = 1800;
    private const FX_FALLBACK    = 110.92;

    public function getExchangeRate(Request $request): JsonResponse
    {
        $cached = Cache::get('fx_eur_inr');
        if ($cached) {
            return response()->json($cached);
        }

        // Attempt 1: Frankfurter (ECB reference rates — server-to-server, no CORS)
        try {
            $res = Http::timeout(5)->get('https://api.frankfurter.app/latest', [
                'from' => 'EUR', 'to' => 'INR',
            ]);
            if ($res->successful()) {
                $rate = $res->json('rates.INR');
                if ($rate && $rate > 50) {
                    $payload = [
                        'rate'   => round($rate, 4),
                        'base'   => 'EUR',
                        'date'   => $res->json('date'),
                        'source' => 'Frankfurter (ECB)',
                        'cached' => false,
                    ];
                    Cache::put('fx_eur_inr', $payload, self::FX_CACHE_TTL);
                    return response()->json($payload);
                }
            }
        } catch (\Throwable) {}

        // Attempt 2: ExchangeRate-API free tier
        try {
            $res = Http::timeout(5)->get('https://api.exchangerate-api.com/v4/latest/EUR');
            if ($res->successful()) {
                $rate = $res->json('rates.INR');
                if ($rate && $rate > 50) {
                    $payload = [
                        'rate'   => round($rate, 4),
                        'base'   => 'EUR',
                        'date'   => $res->json('date'),
                        'source' => 'ExchangeRate-API',
                        'cached' => false,
                    ];
                    Cache::put('fx_eur_inr', $payload, self::FX_CACHE_TTL);
                    return response()->json($payload);
                }
            }
        } catch (\Throwable) {}

        // Both failed — return fallback with clear flag
        return response()->json([
            'rate'     => self::FX_FALLBACK,
            'base'     => 'EUR',
            'date'     => now()->toDateString(),
            'source'   => 'fallback',
            'fallback' => true,
        ], 200); // 200 so JS can still read the rate
    }

    public function calculator(): \Illuminate\View\View
    {
        return view('frontend.cost-calculator');
    }

    public function getFreightRates(Request $request): JsonResponse
    {
        return response()->json(self::FREIGHT_RATES);
    }

    public function getDutyRate(Request $request): JsonResponse
    {
        $hsCode = trim((string) $request->query('hs_code', ''));

        if ($hsCode === '') {
            return response()->json(['error' => 'hs_code query parameter is required'], 422);
        }

        $rates = self::DUTY_TABLE[$hsCode] ?? null;

        if ($rates === null) {
            return response()->json([
                'error'   => "HS code {$hsCode} not found in lookup table",
                'valid'   => array_keys(self::DUTY_TABLE),
            ], 404);
        }

        return response()->json(array_merge(
            ['hs_code' => $hsCode],
            $rates,
            ['source' => 'CBIC Budget 2025-26']
        ));
    }

    public function storeLead(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name'    => 'required|string|max:120',
            'email'   => 'required|email|max:160',
            'phone'   => 'required|string|max:30',
            'company' => 'required|string|max:160',
        ]);

        $data['ip_address'] = $request->ip();

        CalculatorLead::create($data);

        // Notify admin of new calculator lead
        try {
            $adminEmail = ContactSetting::instance()?->email ?: config('mail.from.address');
            if ($adminEmail) {
                Mail::raw(
                    "New India-Europe Calculator Lead\n\n" .
                    "Name:    {$data['name']}\n" .
                    "Email:   {$data['email']}\n" .
                    "Phone:   {$data['phone']}\n" .
                    "Company: {$data['company']}\n" .
                    "IP:      {$data['ip_address']}\n" .
                    "Time:    " . now()->format('d M Y H:i') . " UTC\n\n" .
                    "View leads: " . url('/admin/calculator-leads'),
                    fn ($message) => $message
                        ->to($adminEmail)
                        ->subject('New Calculator Lead — ' . $data['name'] . ' (' . $data['company'] . ')')
                );
            }
        } catch (\Throwable) {}

        return response()->json(['success' => true]);
    }
}
