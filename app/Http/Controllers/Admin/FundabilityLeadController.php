<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FundabilityLeadController extends Controller
{
    private string $baseUrl;
    private string $apiUser;
    private string $apiPass;

    public function __construct()
    {
        $this->baseUrl = env('FUNDABILITY_API_URL', 'https://startups.devmantra.com');
        $this->apiUser = env('FUNDABILITY_API_USER', 'admin');
        $this->apiPass = env('FUNDABILITY_API_PASS', 'DevMantra@2025!');
    }

    public function index(Request $request)
    {
        $page   = max(1, (int) $request->input('page', 1));
        $tier   = $request->input('tier', '');
        $search = $request->input('search', '');

        $statsResponse = Http::withBasicAuth($this->apiUser, $this->apiPass)
            ->timeout(10)
            ->get("{$this->baseUrl}/api/admin/stats");

        $stats = $statsResponse->successful() ? $statsResponse->json() : [];

        $params = ['page' => $page, 'limit' => 20];
        if ($tier) {
            $params['tier'] = $tier;
        }

        $leadsResponse = Http::withBasicAuth($this->apiUser, $this->apiPass)
            ->timeout(10)
            ->get("{$this->baseUrl}/api/admin/leads", $params);

        $leadsData = $leadsResponse->successful()
            ? $leadsResponse->json()
            : ['data' => [], 'total' => 0, 'page' => 1, 'totalPages' => 1];

        $leads = $leadsData['data'] ?? [];

        if ($search) {
            $q = strtolower($search);
            $leads = array_values(array_filter($leads, function ($l) use ($q) {
                return str_contains(strtolower($l['founderName'] ?? ''), $q)
                    || str_contains(strtolower($l['companyName'] ?? ''), $q)
                    || str_contains(strtolower($l['email'] ?? ''), $q);
            }));
        }

        return view('admin.fundability-leads.index', [
            'stats'       => $stats,
            'leads'       => $leads,
            'meta'        => $leadsData,
            'currentTier' => $tier,
            'search'      => $search,
        ]);
    }

    public function export(Request $request)
    {
        $tier = $request->input('tier', '');

        $tierLabels = [
            'top_decile'           => 'Top Decile',
            'series_a_fundable'    => 'Series A Ready',
            'seed_ready_with_gaps' => 'Seed Ready',
            'idea_stage'           => 'Idea Stage',
        ];

        $allLeads  = [];
        $page      = 1;
        $totalPages = 1;

        do {
            $params = ['page' => $page, 'limit' => 100];
            if ($tier) {
                $params['tier'] = $tier;
            }

            $response = Http::withBasicAuth($this->apiUser, $this->apiPass)
                ->timeout(30)
                ->get("{$this->baseUrl}/api/admin/leads", $params);

            if (!$response->successful()) {
                break;
            }

            $data       = $response->json();
            $allLeads   = array_merge($allLeads, $data['data'] ?? []);
            $totalPages = $data['totalPages'] ?? 1;
            $page++;
        } while ($page <= $totalPages);

        $filename = 'fundability-leads-' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Cache-Control'       => 'no-store',
        ];

        $callback = function () use ($allLeads, $tierLabels) {
            $handle = fopen('php://output', 'w');

            // UTF-8 BOM so Excel auto-detects encoding
            fwrite($handle, "\xEF\xBB\xBF");

            fputcsv($handle, [
                'Founder Name', 'Company Name', 'Email', 'Phone',
                'Sector', 'Score', 'Tier', 'Date Submitted',
            ]);

            foreach ($allLeads as $lead) {
                $date = '';
                if (!empty($lead['createdAt'])) {
                    $cleaned = trim(preg_replace('/\s*\([^)]+\)/', '', $lead['createdAt']));
                    try {
                        $date = \Carbon\Carbon::parse($cleaned)->format('d M Y');
                    } catch (\Exception $e) {
                        $date = $lead['createdAt'];
                    }
                }

                fputcsv($handle, [
                    $lead['founderName'] ?? '',
                    $lead['companyName'] ?? '',
                    $lead['email']       ?? '',
                    $lead['phone']       ?? '',
                    $lead['sector']      ?? '',
                    $lead['totalScore']  ?? '',
                    $tierLabels[$lead['tier'] ?? ''] ?? ($lead['tier'] ?? ''),
                    $date,
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function show(string $id)
    {
        $response = Http::withBasicAuth($this->apiUser, $this->apiPass)
            ->timeout(10)
            ->get("{$this->baseUrl}/api/admin/leads/{$id}");

        if (!$response->successful()) {
            abort(404, 'Lead not found.');
        }

        $lead = $response->json();

        return view('admin.fundability-leads.show', compact('lead'));
    }
}
