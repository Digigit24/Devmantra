<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Lets every completed ESOP Calculator session be reopened later at a
 * private, unguessable URL (/esop-calculator/report/{share_token}) instead
 * of only existing as ephemeral client-side state in the browser tab that
 * submitted it, or as plain text in the emailed copy.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('esop_leads', function (Blueprint $table) {
            $table->string('share_token', 64)->nullable()->unique()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('esop_leads', function (Blueprint $table) {
            $table->dropColumn('share_token');
        });
    }
};
