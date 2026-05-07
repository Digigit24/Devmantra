<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalculatorLead extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'status',
        'ip_address',
    ];
}
