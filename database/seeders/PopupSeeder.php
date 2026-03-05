<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class PopupSeeder extends Seeder
{
    public function run(): void
    {
        $points = implode("\n", [
            'India has one of the most complex, multi-layered compliance environments in the world.',
            'Most foreign companies underestimate the regulatory burden and get caught mid-expansion.',
            'Dev Mantra has helped 50+ businesses set up, structure, and scale in India — compliantly.',
            'One call. No commitment. Real answers to your India questions.',
        ]);

        SiteSetting::setMany([
            'popup_enabled'            => '1',
            'popup_show_exit_intent'   => '1',
            'popup_show_scroll'        => '1',
            'popup_trigger_scroll'     => '55',
            'popup_headline'           => 'Expanding to or in India? Avoid costly compliance mistakes.',
            'popup_subtext'            => '',
            'popup_points'             => $points,
            'popup_primary_cta_text'   => 'Book a Free 20-Minute Strategy Call',
            'popup_primary_cta_url'    => '#contact',
            'popup_secondary_cta_text' => 'Explore Our Services',
            'popup_secondary_cta_url'  => '/services',
            'popup_supporting_text'    => 'No sales pitch. Just a focused conversation with a senior advisor.',
        ]);

        $this->command->info('Popup settings seeded successfully.');
    }
}
