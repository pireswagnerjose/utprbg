<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    protected $table = 'wards';
    protected $guarded  = [];

    public function prison_unit()
    {
        return $this->belongsTo(PrisonUnit::class);
    }

    public function cells()
    {
        return $this->hasMany(Cell::class);
    }
}
