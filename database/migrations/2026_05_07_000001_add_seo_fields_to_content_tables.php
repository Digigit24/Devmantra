<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $tables = [
        'blogs',
        'services',
        'case_studies',
        'reports',
        'newsletters',
    ];

    public function up(): void
    {
        foreach ($this->tables as $table) {
            Schema::table($table, function (Blueprint $blueprint) use ($table) {
                if (! Schema::hasColumn($table, 'meta_title')) {
                    $blueprint->string('meta_title', 60)->nullable();
                }
                if (! Schema::hasColumn($table, 'meta_description')) {
                    $blueprint->text('meta_description')->nullable();
                }
                if (! Schema::hasColumn($table, 'og_image')) {
                    $blueprint->string('og_image')->nullable();
                }
                if (! Schema::hasColumn($table, 'canonical_url')) {
                    $blueprint->string('canonical_url')->nullable();
                }
                if (! Schema::hasColumn($table, 'noindex')) {
                    $blueprint->boolean('noindex')->default(false);
                }
                if (! Schema::hasColumn($table, 'custom_head')) {
                    $blueprint->text('custom_head')->nullable();
                }
            });
        }
    }

    public function down(): void
    {
        $newColumns = ['meta_title', 'og_image', 'canonical_url', 'noindex', 'custom_head'];

        foreach ($this->tables as $table) {
            Schema::table($table, function (Blueprint $blueprint) use ($table, $newColumns) {
                foreach ($newColumns as $column) {
                    if (Schema::hasColumn($table, $column)) {
                        $blueprint->dropColumn($column);
                    }
                }
            });
        }
    }
};
