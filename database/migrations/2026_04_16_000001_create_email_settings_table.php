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
        Schema::create('email_settings', function (Blueprint $table) {
            $table->id();
            $table->string('smtp_host')->default('smtp.mailtrap.io');
            $table->integer('smtp_port')->default(587);
            $table->string('smtp_username')->nullable();
            $table->text('smtp_password')->nullable();
            $table->enum('smtp_encryption', ['tls', 'ssl'])->default('tls');
            $table->string('from_name')->default('Devmantra');
            $table->string('from_email')->default('noreply@devmantra.com');
            $table->string('reply_to_email')->nullable();
            $table->boolean('enable_reply_feature')->default(true);
            $table->boolean('is_active')->default(true);
            $table->text('business_email_domains')->nullable()->comment('Comma-separated list of allowed business domains');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_settings');
    }
};
