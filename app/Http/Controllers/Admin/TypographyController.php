<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class TypographyController extends Controller
{
    /** All selectable fonts. 'type' = google | local */
    public const FONTS = [
        ['key' => 'Inter',                          'label' => 'Inter',             'type' => 'google', 'fallback' => 'sans-serif'],
        ['key' => 'Poppins',                        'label' => 'Poppins',           'type' => 'google', 'fallback' => 'sans-serif'],
        ['key' => 'Onest',                          'label' => 'Onest',             'type' => 'google', 'fallback' => 'sans-serif'],
        ['key' => 'Space Grotesk',                  'label' => 'Space Grotesk',     'type' => 'google', 'fallback' => 'sans-serif'],
        ['key' => 'Teko',                           'label' => 'Teko',              'type' => 'google', 'fallback' => 'sans-serif'],
        ['key' => 'Phudu',                          'label' => 'Phudu',             'type' => 'google', 'fallback' => 'sans-serif'],
        ['key' => 'Playfair Display',               'label' => 'Playfair Display',  'type' => 'google', 'fallback' => 'serif'],
        ['key' => 'Besley',                         'label' => 'Besley',            'type' => 'google', 'fallback' => 'serif'],
        ['key' => 'Satisfy',                        'label' => 'Satisfy',           'type' => 'google', 'fallback' => 'cursive'],
        ['key' => 'Platform',                       'label' => 'Platform',          'type' => 'local',  'fallback' => 'serif'],
        ['key' => 'MangoGrotesque',                 'label' => 'Mango Grotesque',   'type' => 'local',  'fallback' => 'sans-serif'],
        ['key' => 'ClashDisplay-Medium',            'label' => 'Clash Display',     'type' => 'local',  'fallback' => 'sans-serif'],
        ['key' => 'dirtyline-36daysoftype-2022',    'label' => 'Dirty Line',        'type' => 'local',  'fallback' => 'cursive'],
    ];

    /** Google Fonts family strings (URL-encoded) for each supported font */
    private const GOOGLE_FONT_PARAMS = [
        'Inter'            => 'Inter:ital,opsz,wght@0,14..32,300..700;1,14..32,400..600',
        'Poppins'          => 'Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400',
        'Onest'            => 'Onest:wght@300..700',
        'Space Grotesk'    => 'Space+Grotesk:wght@300..700',
        'Playfair Display' => 'Playfair+Display:ital,wght@0,400..900;1,400..900',
        'Besley'           => 'Besley:ital,wght@0,400..900;1,400..900',
        'Satisfy'          => 'Satisfy',
        'Teko'             => 'Teko:wght@300..700',
        'Phudu'            => 'Phudu:wght@300..900',
    ];

    /**
     * Build a Google Fonts CSS URL for all the given font keys that are Google Fonts.
     * Returns null if no Google Fonts are present in the list.
     */
    public static function buildGoogleFontsUrl(array $fontKeys): ?string
    {
        $families = [];
        foreach (array_unique(array_filter($fontKeys)) as $key) {
            if (isset(self::GOOGLE_FONT_PARAMS[$key])) {
                $families[] = 'family=' . self::GOOGLE_FONT_PARAMS[$key];
            }
        }
        if (empty($families)) {
            return null;
        }
        return 'https://fonts.googleapis.com/css2?' . implode('&', $families) . '&display=swap';
    }

    /** Return ALL Google Fonts as a single URL (used in admin typography preview) */
    public static function allGoogleFontsUrl(): string
    {
        $all = array_keys(self::GOOGLE_FONT_PARAMS);
        return self::buildGoogleFontsUrl($all) ?? '';
    }

    // ── Admin CRUD ────────────────────────────────────────────

    public function edit()
    {
        return view('admin.account.typography', [
            'settings' => SiteSetting::all_cached(),
            'fonts'    => self::FONTS,
        ]);
    }

    public function update(Request $request)
    {
        $elements = ['font_body', 'font_h1', 'font_h2', 'font_h3', 'font_h4', 'font_h5', 'font_h6', 'font_p'];

        foreach ($elements as $key) {
            SiteSetting::set($key, $request->input($key, ''));
        }

        return back()->with('success', 'Typography settings saved successfully.');
    }
}
