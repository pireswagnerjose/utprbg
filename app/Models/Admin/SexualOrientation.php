<?php

namespace App\Models\Admin;

use App\Models\Main\Prisoner;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SexualOrientation extends Model
{
    use HasFactory;
    protected $table = 'sexual_orientations';
    protected $guarded = [];

    public function prisoners()
    {
        return $this->hasMany(Prisoner::class);
    }
}
