<?php

namespace App\Models\Admin;

use App\Models\Main\ExternalExit;
use App\Models\Main\Prison;
use App\Models\Main\UnitAddress;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrisonUnit extends Model
{
    use HasFactory;
    protected $table    = 'prison_units';
    protected $guarded  = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    
    public function prisions()
    {
        return $this->hasMany(Prison::class);
    }

    public function external_exits()
    {
        return $this->hasMany(ExternalExit::class);
    }

    public function unit_addresses()
    {
        return $this->hasMany(UnitAddress::class);
    }

    public function wards()
    {
        return $this->hasMany(Ward::class);
    }
    
    public function cells()
    {
        return $this->hasMany(Cell::class);
    }

    // public function penal_type_processes()
    // {
    //     return $this->hasMany(PenalTypeProcess::class);
    // }
}
