<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        return static::firstOrCreate([]);
    }
}
