<?php

namespace App\Models\Admin;

use App\Models\Main\Prisoner;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ethnicity extends Model
{
    use HasFactory;
    protected $table    = 'ethnicities';
    protected $guarded  = [];

    public function prisoners()
    {
        return $this->hasMany(Prisoner::class);
    }
}
