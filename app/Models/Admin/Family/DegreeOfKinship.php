<?php

namespace App\Models\Admin\Family;

use App\Models\Main\Family;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DegreeOfKinship extends Model
{
    use HasFactory;
    protected $table = 'degrees_of_kinship';
    protected $guarded = [];

    public function families()
    {
        return $this->hasMany(Family::class);
    }
}
