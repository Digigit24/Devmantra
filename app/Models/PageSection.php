<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageSection extends Model
{
    protected $fillable = ['page_id', 'section_type', 'section_data', 'sort_order', 'is_active'];

    protected $casts = [
        'section_data' => 'array',
        'is_active'    => 'boolean',
        'sort_order'   => 'integer',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
