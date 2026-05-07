<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->json('tags')->nullable()->after('tag');
        });

        // Migrate existing single-tag data into the JSON array column
        DB::table('events')->whereNotNull('tag')->chunkById(100, function ($rows) {
            foreach ($rows as $row) {
                DB::table('events')->where('id', $row->id)->update([
                    'tags' => json_encode([$row->tag]),
                ]);
            }
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('tag');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->char('tag', 50)->default('events')->after('tags');
        });

        DB::table('events')->whereNotNull('tags')->chunkById(100, function ($rows) {
            foreach ($rows as $row) {
                $arr = json_decode($row->tags, true);
                DB::table('events')->where('id', $row->id)->update([
                    'tag' => is_array($arr) && count($arr) ? $arr[0] : 'events',
                ]);
            }
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('tags');
        });
    }
};
