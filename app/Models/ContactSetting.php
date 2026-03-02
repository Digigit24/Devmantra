<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class ContactSetting extends Model
{
    protected $fillable = [
        'phone',
        'email',
        'address',
        'google_map_embed',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'instagram_url',
        'office_hours',
    ];

    public static function instance(): self
    {
        try {
            if (!Schema::hasTable('contact_settings')) {
                return new static;
            }
            return static::firstOrCreate([]);
        } catch (\Exception $e) {
            return new static;
        }
    }
}
