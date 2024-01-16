<?php

namespace App\Models\Admin;

use App\Models\Main\Prisoner;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'countries';
    protected $guarded = [];

    public function prisoners()
    {
        return $this->hasMany(Prisoner::class);
    }
}
