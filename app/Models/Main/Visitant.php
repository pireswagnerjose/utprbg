<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitant extends Model
{
    use HasFactory;
    protected $table    = 'visitants';
    protected $guarded  = [];

    public function identification_cards()
    {
        return $this->hasMany(IdentificationCard::class);
    }
    public function visitant_documents()
    {
        return $this->hasMany(VisitantDocument::class);
    }
}
