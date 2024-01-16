<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    use HasFactory;
    protected $table = 'cells';
    protected $guarded  = [];

    public function prison_unit()
    {
        return $this->belongsTo(PrisonUnit::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }
}
