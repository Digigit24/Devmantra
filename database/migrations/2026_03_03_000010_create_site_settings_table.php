<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Seed defaults
        $defaults = [
            'brand_color_from'       => '#1b3c6b',
            'brand_color_to'         => '#4a73c4',
            'primary_button_text'    => 'Book a Free Consultation',
            'primary_button_url'     => '/contact',
            'secondary_button_text'  => 'Get a Free Financial Review',
            'secondary_button_link'  => '',
            'button_new_tab'         => '1',
        ];

        foreach ($defaults as $key => $value) {
            DB::table('site_settings')->insertOrIgnore(['key' => $key, 'value' => $value, 'created_at' => now(), 'updated_at' => now()]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
