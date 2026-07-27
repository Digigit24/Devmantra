<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EsopEmployee extends Model
{
    protected $fillable = [
        'esop_lead_id',
        'emp_name',
        'emp_code',
        'emp_designation',
        'emp_department',
        'emp_seniority',
        'emp_years',
        'param_scores',
        'param_selections',
        'total_score',
        'final_grant_percent',
        'share_of_pool_percent',
        'rank',
        'tier_pool_applied',
        'ai_content',
        'sort_order',
    ];

    protected $casts = [
        'param_scores'       => 'array',
        'param_selections'   => 'array',
        'ai_content'          => 'array',
        'tier_pool_applied'   => 'boolean',
    ];

    public function lead(): BelongsTo
    {
        return $this->belongsTo(EsopLead::class, 'esop_lead_id');
    }
}
