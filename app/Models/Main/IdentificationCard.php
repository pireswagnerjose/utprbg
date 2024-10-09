<?php

namespace App\Models\Main;

use App\Models\Admin\Family\DegreeOfKinship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentificationCard extends Model
{
    use HasFactory;
    protected $table    = 'identification_cards';
    protected $guarded  = [];

    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class);
    }
    public function visitant()
    {
        return $this->belongsTo(Visitant::class);
    }

    public function degree_of_kinship()
    {
        return $this->belongsTo(DegreeOfKinship::class);
    }
}
