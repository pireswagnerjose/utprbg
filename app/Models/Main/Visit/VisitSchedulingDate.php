<?php

namespace App\Models\Main\Visit;

use App\Models\Admin\Ward;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitSchedulingDate extends Model
{
    use HasFactory;
    protected $table = 'visit_scheduling_dates';
    protected $fillable = [
        'start_date',
        'end_date',
        'user_create',
        'user_update',
        'prison_unit_id',
        'ward_id',
    ];

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }
}
