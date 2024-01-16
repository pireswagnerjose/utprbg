<?php

namespace App\Models\Admin;

use App\Models\Main\Prisoner;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationLevel extends Model
{
    use HasFactory;
    protected $table    = 'education_levels';
    protected $guarded  = [];

    public function prisoners()
    {
        return $this->hasMany(Prisoner::class);
    }
}
