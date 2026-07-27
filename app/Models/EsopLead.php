<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * A single ESOP Calculator "session" — one company / pool setup + the
 * contact who ran it. Holds many EsopEmployee rows (one per employee
 * scored), matching the Setup + Scoring sheets of ESOP_Allocation_Model_V6.xlsx.
 */
class EsopLead extends Model
{
    protected $fillable = [
        'share_token',
        'name',
        'email',
        'phone',
        'company',
        'website',
        'industry',
        'company_stage',
        'esop_pool_percent',
        'hiring_reserve_percent',
        'planned_headcount',
        'pool_distribute_percent',
        'tier_pool_leadership',
        'tier_pool_senior_management',
        'tier_pool_mid_level',
        'tier_pool_junior',
        'tier_pool_others',
        'result_summary',
        'ai_content',
        'status',
        'submitted_at',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'result_summary' => 'array',
        'ai_content'      => 'array',
        'submitted_at'    => 'datetime',
    ];

    public const STATUSES = ['partial', 'new', 'read', 'archived'];

    public function employees(): HasMany
    {
        return $this->hasMany(EsopEmployee::class)->orderBy('sort_order');
    }
}
