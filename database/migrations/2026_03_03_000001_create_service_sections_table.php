<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->string('section_type', 100);  // hero, overview, services-grid, etc.
            $table->json('section_data')->nullable(); // all content as JSON
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['service_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_sections');
    }
};
