<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisionLead extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'city',
        'website',
        'industry',
        'business_type',
        'years_in_business',
        'team_size',
        'annual_revenue',
        'current_stage',
        'challenges',
        'y1_goal',
        'y1_detail',
        'y1_excitement',
        'y3_goal',
        'y3_proud',
        'y5_known',
        'y5_achievements',
        'y5_headline',
        'founder_identity',
        'focus_areas',
        'personal_goals',
        'other_answers',
        'ai_content',
        'status',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'challenges'       => 'array',
        'y5_achievements'  => 'array',
        'founder_identity' => 'array',
        'focus_areas'      => 'array',
        'personal_goals'   => 'array',
        'other_answers'    => 'array',
        'ai_content'       => 'array',
    ];

    public const STATUSES = ['new', 'read', 'archived'];
}
