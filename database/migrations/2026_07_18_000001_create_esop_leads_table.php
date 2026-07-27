<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * "esop_leads" is a session: one company + ESOP pool setup + the contact
 * details of the person filling in the calculator. Each session can contain
 * many scored employees (see esop_employees / EsopEmployee model) — this
 * mirrors the Setup sheet of ESOP_Allocation_Model_V6.xlsx, which is a single
 * pool configuration shared by every employee scored in that workbook.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('esop_leads', function (Blueprint $table) {
            $table->id();

            // Contact (who is filling in the calculator / who receives the report)
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            // Company / Setup-sheet inputs
            $table->string('company')->nullable();
            $table->string('website')->nullable();
            $table->string('industry')->nullable();
            $table->string('company_stage')->nullable();

            $table->decimal('esop_pool_percent', 6, 2)->nullable();       // Setup!C11
            $table->decimal('hiring_reserve_percent', 6, 2)->default(10); // Setup!C12 (design defaults to 10%)
            $table->unsignedInteger('planned_headcount')->nullable();     // Setup!C13
            $table->decimal('pool_distribute_percent', 6, 2)->default(100); // Setup!C21

            // Optional per-seniority tier pools (Setup!C28:C32), % of total equity
            $table->decimal('tier_pool_leadership', 6, 2)->nullable();
            $table->decimal('tier_pool_senior_management', 6, 2)->nullable();
            $table->decimal('tier_pool_mid_level', 6, 2)->nullable();

            // Snapshot of the last full-session calculation (see EsopAllocationCalculator::calculateSession)
            $table->json('result_summary')->nullable();
            $table->json('ai_content')->nullable();

            $table->string('status')->default('partial'); // partial | new | read | archived
            $table->timestamp('submitted_at')->nullable();
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();

            $table->timestamps();

            $table->index('status');
            $table->index('email');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('esop_leads');
    }
};
