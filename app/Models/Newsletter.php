<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Newsletter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'edition_label',
        'is_featured',
        'meta_description',
        'status',
        'published_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    public static function booted(): void
    {
        static::creating(function (Newsletter $newsletter) {
            if (empty($newsletter->slug)) {
                $newsletter->slug = Str::slug($newsletter->title);
            }
            $newsletter->slug = static::ensureUniqueSlug($newsletter->slug, $newsletter->id);
        });

        static::updating(function (Newsletter $newsletter) {
            if ($newsletter->isDirty('title') && !$newsletter->isDirty('slug')) {
                $newsletter->slug = Str::slug($newsletter->title);
            }
            $newsletter->slug = static::ensureUniqueSlug($newsletter->slug, $newsletter->id);
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
        return url('/newsletter/' . $this->slug);
    }
}
