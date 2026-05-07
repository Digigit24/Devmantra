<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Career extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'location',
        'type',
        'description',
        'featured_image',
        'meta_description',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public static function booted(): void
    {
        static::creating(function (Career $career) {
            if (empty($career->slug)) {
                $career->slug = Str::slug($career->title);
            }
            $career->slug = static::ensureUniqueSlug($career->slug, $career->id);
        });

        static::updating(function (Career $career) {
            if ($career->isDirty('title') && !$career->isDirty('slug')) {
                $career->slug = Str::slug($career->title);
            }
            $career->slug = static::ensureUniqueSlug($career->slug, $career->id);
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

    public function applications()
    {
        return $this->hasMany(CareerApplication::class);
    }

    public function getUrlAttribute(): string
    {
        return url('/careers/' . $this->slug);
    }
}
