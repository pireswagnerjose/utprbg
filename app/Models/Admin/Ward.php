<?php

namespace App\Models\Admin;

use App\Models\Main\UnitAddress;
use App\Models\Main\Visit\VisitControl;
use App\Models\Main\Visit\VisitSchedulingDate;
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

    public function unit_addresse_ward()
    {
        return $this->hasMany(UnitAddress::class);
    }

    public function visit_scheduling_dates()
    {
        return $this->hasMany(VisitSchedulingDate::class);
    }

    public function cells()
    {
        return $this->hasMany(Cell::class);
    }

    /**
     * faz o relacionamento com a tabela Controle de Visitas
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function visit_controls()
    {
        return $this->hasMany(VisitControl::class);
    }
}
