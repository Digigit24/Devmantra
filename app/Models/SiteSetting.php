<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value'];

    /** In-memory cache so we only query the DB once per request */
    private static ?array $cache = null;

    private static function loadCache(): void
    {
        if (self::$cache !== null) return;
        try {
            if (!Schema::hasTable('site_settings')) {
                self::$cache = [];
                return;
            }
            self::$cache = static::all()->pluck('value', 'key')->toArray();
        } catch (\Exception) {
            self::$cache = [];
        }
    }

    public static function get(string $key, string $default = ''): string
    {
        self::loadCache();
        return self::$cache[$key] ?? $default;
    }

    public static function set(string $key, string $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        // Invalidate cache
        self::$cache = null;
    }

    public static function setMany(array $pairs): void
    {
        foreach ($pairs as $key => $value) {
            static::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        self::$cache = null;
    }

    /** Returns all settings as a flat key→value array (cached) */
    public static function all_cached(): array
    {
        self::loadCache();
        return self::$cache ?? [];
    }
}
