<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vision_leads', function (Blueprint $table) {
            $table->id();

            // Contact & company
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('city')->nullable();
            $table->string('website')->nullable();

            // Business profile
            $table->string('industry')->nullable();
            $table->string('business_type')->nullable();
            $table->string('years_in_business')->nullable();
            $table->string('team_size')->nullable();
            $table->string('annual_revenue')->nullable();

            // Current state
            $table->string('current_stage')->nullable();
            $table->json('challenges')->nullable();

            // Strategic goals
            $table->string('y1_goal')->nullable();
            $table->text('y1_detail')->nullable();
            $table->text('y1_excitement')->nullable();
            $table->string('y3_goal')->nullable();
            $table->text('y3_proud')->nullable();
            $table->text('y5_known')->nullable();
            $table->json('y5_achievements')->nullable();
            $table->text('y5_headline')->nullable();

            // Founder
            $table->json('founder_identity')->nullable();
            $table->json('focus_areas')->nullable();
            $table->json('personal_goals')->nullable();

            // Other custom answers and AI output
            $table->json('other_answers')->nullable();
            $table->json('ai_content')->nullable();

            // Admin
            $table->string('status')->default('new');
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
        Schema::dropIfExists('vision_leads');
    }
};
