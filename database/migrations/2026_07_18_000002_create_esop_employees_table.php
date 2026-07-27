<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * One row per employee scored inside an esop_leads session — mirrors one row
 * on the Scoring sheet of ESOP_Allocation_Model_V6.xlsx. Final grant % is
 * always recomputed for the WHOLE session (all sibling employees together)
 * by EsopAllocationCalculator::calculateSession(), never per row in isolation,
 * because V6's grant math is pro-rata across peers.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('esop_employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('esop_lead_id')->constrained('esop_leads')->cascadeOnDelete();

            $table->string('emp_name')->nullable();
            $table->string('emp_code')->nullable();
            $table->string('emp_designation')->nullable();
            $table->string('emp_department')->nullable();
            $table->string('emp_seniority')->nullable(); // Leadership | Senior Management | Mid-Level
            $table->decimal('emp_years', 5, 2)->nullable();

            $table->json('param_scores')->nullable();      // key => 0-5
            $table->json('param_selections')->nullable();   // key => matched statement text, for admin/email display
            $table->unsignedInteger('total_score')->nullable(); // /100

            // Last computed result for this employee (see EsopAllocationCalculator::calculateSession)
            $table->decimal('final_grant_percent', 10, 6)->nullable();
            $table->decimal('share_of_pool_percent', 10, 6)->nullable();
            $table->unsignedInteger('rank')->nullable();
            $table->boolean('tier_pool_applied')->default(false);
            $table->json('ai_content')->nullable();

            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index('esop_lead_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('esop_employees');
    }
};
