<?php

namespace App\Models\Admin;

use App\Models\Main\Address;
use App\Models\Main\ExternalExit;
use App\Models\Main\Prisoner;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $table    = 'states';
    protected $guarded  = [];

    public function municipalities()
    {
        return $this->hasMany(Municipality::class);
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
}
