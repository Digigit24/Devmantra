<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $aboutPageId = DB::table('pages')->where('name', 'about')->value('id');

        if (! $aboutPageId) {
            return;
        }

        // Shift existing sections with sort_order >= 4 up by 1
        DB::table('page_sections')
            ->where('page_id', $aboutPageId)
            ->where('sort_order', '>=', 4)
            ->orderByDesc('sort_order')
            ->get()
            ->each(function ($section) {
                DB::table('page_sections')
                    ->where('id', $section->id)
                    ->update(['sort_order' => $section->sort_order + 1]);
            });

        // Insert the new Knowledge Partner section at sort_order 4
        DB::table('page_sections')->insert([
            'page_id'      => $aboutPageId,
            'section_type' => 'about-knowledge-partner',
            'section_data' => json_encode([
                'label'             => 'Our Knowledge Partner',
                'title'             => 'Our Knowledge Partner',
                'title_highlight'   => 'Partner',
                'description'       => 'N.Tatia & Associates is a professional Chartered Accountants firm associated with Dev Mantra, rendering specialised audit services and a wide array of consultancy services in the areas of direct taxes, indirect tax, GST, transfer pricing, dispute resolution, internal controls and various technical issues. Drawing on the knowledge and experience of our partners & associates we provide process excellence from strategy to implementation with proficiency in service delivery. The firm registration number issued by ICAI is S011067S and is Peer Reviewed by The Institute of Chartered Accountants of India. The Firm has established practices across industries of all sizes.',
                'logo_image'        => 'assets/img/about-us/caindia.jpg',
                'certificate_image' => 'assets/img/about-us/peercertificate.jpg',
            ]),
            'sort_order'   => 4,
            'is_active'    => true,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);
    }

    public function down(): void
    {
        $aboutPageId = DB::table('pages')->where('name', 'about')->value('id');

        if (! $aboutPageId) {
            return;
        }

        // Remove the knowledge partner section
        DB::table('page_sections')
            ->where('page_id', $aboutPageId)
            ->where('section_type', 'about-knowledge-partner')
            ->delete();

        // Shift sections with sort_order > 4 back down by 1
        DB::table('page_sections')
            ->where('page_id', $aboutPageId)
            ->where('sort_order', '>', 4)
            ->orderBy('sort_order')
            ->get()
            ->each(function ($section) {
                DB::table('page_sections')
                    ->where('id', $section->id)
                    ->update(['sort_order' => $section->sort_order - 1]);
            });
    }
};
