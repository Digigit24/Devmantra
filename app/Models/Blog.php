<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'featured_image',
        'category', 'meta_description', 'read_time', 'is_featured',
        'status', 'published_at',
        // SEO panel fields
        'meta_title', 'og_image', 'canonical_url', 'noindex', 'custom_head',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'noindex'     => 'boolean',
        'published_at' => 'datetime',
    ];

    public static function booted(): void
    {
        static::creating(function (Blog $blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }
            $blog->slug = static::ensureUniqueSlug($blog->slug, $blog->id);
        });

        static::updating(function (Blog $blog) {
            if ($blog->isDirty('title') && !$blog->isDirty('slug')) {
                $blog->slug = Str::slug($blog->title);
            }
            $blog->slug = static::ensureUniqueSlug($blog->slug, $blog->id);
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
        return url('/blog/' . $this->slug);
    }

    /**
     * Returns a plain-text excerpt safe for display in listings.
     * Strips HTML tags, decodes entities, and collapses whitespace
     * from both the excerpt field and the content fallback.
     */
    public function getCleanExcerptAttribute(): string
    {
        $raw = $this->excerpt ?? $this->content ?? '';
        $text = html_entity_decode(strip_tags($raw), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        return trim(preg_replace('/\s+/', ' ', $text));
    }
}
