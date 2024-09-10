<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentificationCard extends Model
{
    use HasFactory;
    protected $table    = 'identification_cards';
    protected $guarded  = [];

    public function prisoners()
    {
        return $this->belongsTo(Prisoner::class);
    }
    public function visitants()
    {
        return $this->belongsTo(Visitant::class);
    }
}
