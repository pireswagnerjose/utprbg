<?php

namespace App\Models\Main;

use App\Models\Admin\Cell;
use App\Models\Admin\PrisonUnit;
use App\Models\Admin\Ward;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitAddress extends Model
{
    use HasFactory;
    protected $table    = 'unit_addresses';
    protected $guarded  = [];

    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class);
    }

    public function prison_unit()
    {
        return $this->belongsTo(PrisonUnit::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function cell()
    {
        return $this->belongsTo(Cell::class);
    }
}
