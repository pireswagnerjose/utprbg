<?php

namespace App\Models\Admin\Family;

use App\Models\Main\Family;
use App\Models\Main\IdentificationCard;
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

    public function identification_cards()
    {
        return $this->hasMany(IdentificationCard::class);
    }
}
