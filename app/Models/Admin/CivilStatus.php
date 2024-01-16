<?php

namespace App\Models\Admin;

use App\Models\Main\Prisoner;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CivilStatus extends Model
{
    use HasFactory;
    protected $table = 'civil_statuses';
    protected $guarded = [];

    public function prisoners()
    {
        return $this->hasMany(Prisoner::class);
    }
}
