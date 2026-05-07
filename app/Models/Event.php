<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    const TAGS = [
        'events'          => 'Events',
        'media-and-news'  => 'Media & News',
        'team-activities' => 'Team Activities',
        'achievements'    => 'Achievements',
    ];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'featured_image',
        'meta_description',
        'status',
        'published_at',
        'sort_order',
        'hero_image_url',
        'tags',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'sort_order'   => 'integer',
        'tags'         => 'array',
    ];

    public static function booted(): void
    {
        static::creating(function (Event $event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title);
            }
            $event->slug = static::ensureUniqueSlug($event->slug, $event->id);
        });

        static::updating(function (Event $event) {
            if ($event->isDirty('title') && !$event->isDirty('slug')) {
                $event->slug = Str::slug($event->title);
            }
            $event->slug = static::ensureUniqueSlug($event->slug, $event->id);
        });
    }

    private static function ensureUniqueSlug(string $slug, ?int $excludeId = null): string
    {
        $original = $slug;
        $count = 1;
        $query = static::withTrashed()->where('slug', $slug);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }
        while ($query->exists()) {
            $slug = $original . '-' . $count++;
            $query = static::withTrashed()->where('slug', $slug);
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
        }
        return $slug;
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function galleryImages()
    {
        return $this->hasMany(EventImage::class)->orderBy('sort_order');
    }

    public function getUrlAttribute(): string
    {
        return url('/events/' . $this->slug);
    }
}
