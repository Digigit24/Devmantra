<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * ESOP_Allocation_Model_V6.xlsx Setup!B28:B32 ring-fences an optional tier
 * pool per seniority level for all FIVE levels — Leadership, Senior
 * Management, Mid-Level, Junior, and Others (Default). The original
 * esop_leads migration only added columns for the first three. This adds
 * the missing two so the web calculator can match the Excel model exactly.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('esop_leads', function (Blueprint $table) {
            $table->decimal('tier_pool_junior', 6, 2)->nullable()->after('tier_pool_mid_level');
            $table->decimal('tier_pool_others', 6, 2)->nullable()->after('tier_pool_junior');
        });
    }

    public function down(): void
    {
        Schema::table('esop_leads', function (Blueprint $table) {
            $table->dropColumn(['tier_pool_junior', 'tier_pool_others']);
        });
    }
};
