<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('image_meta', function (Blueprint $table) {
            $table->id();
            $table->string('rel_path', 500)->unique();
            $table->string('alt_text', 500)->nullable();
            $table->string('alt_text_suggestion', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('image_meta');
    }
};
