<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bot_prevention_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address')->index();
            $table->enum('form_type', ['contact', 'consultation', 'career', 'newsletter']);
            $table->integer('submission_count')->default(1);
            $table->timestamp('last_submitted_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
            $table->unique(['ip_address', 'form_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bot_prevention_logs');
    }
};
