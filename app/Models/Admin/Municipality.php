<?php

namespace App\Models\Admin;

use App\Models\Main\Address;
use App\Models\Main\ExternalExit;
use App\Models\Main\Prisoner;
use App\Models\Main\Visitant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;
    protected $table    = 'municipalities';
    protected $guarded  = [];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function prisoners()
    {
        return $this->hasMany(Prisoner::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function external_exits()
    {
        return $this->hasMany(ExternalExit::class);
    }

    public function visitants()
    {
        return $this->hasMany(Visitant::class);
    }
}
