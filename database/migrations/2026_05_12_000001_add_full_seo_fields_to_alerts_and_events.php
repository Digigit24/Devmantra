<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alerts', function (Blueprint $table) {
            $table->string('meta_title', 120)->nullable()->after('meta_description');
            $table->string('og_image', 512)->nullable()->after('meta_title');
            $table->string('canonical_url', 512)->nullable()->after('og_image');
            $table->boolean('noindex')->default(false)->after('canonical_url');
            $table->text('custom_head')->nullable()->after('noindex');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->string('meta_title', 120)->nullable()->after('meta_description');
            $table->string('og_image', 512)->nullable()->after('meta_title');
            $table->string('canonical_url', 512)->nullable()->after('og_image');
            $table->boolean('noindex')->default(false)->after('canonical_url');
            $table->text('custom_head')->nullable()->after('noindex');
        });
    }

    public function down(): void
    {
        Schema::table('alerts', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'og_image', 'canonical_url', 'noindex', 'custom_head']);
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'og_image', 'canonical_url', 'noindex', 'custom_head']);
        });
    }
};
