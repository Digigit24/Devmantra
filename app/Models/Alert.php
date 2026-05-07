<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Alert extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'tag',
        'meta_description',
        'read_time',
        'is_featured',
        'status',
        'published_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    public static function booted(): void
    {
        static::creating(function (Alert $item) {
            if (empty($item->slug)) {
                $item->slug = Str::slug($item->title);
            }
            $item->slug = static::ensureUniqueSlug($item->slug, $item->id);
        });

        static::updating(function (Alert $item) {
            if ($item->isDirty('title') && !$item->isDirty('slug')) {
                $item->slug = Str::slug($item->title);
            }
            $item->slug = static::ensureUniqueSlug($item->slug, $item->id);
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

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getUrlAttribute(): string
    {
        return url('/alert/' . $this->slug);
    }
}
