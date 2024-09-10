<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitantDocument extends Model
{
    use HasFactory;
    protected $table    = 'visitant_documents';
    protected $guarded  = [];


    public function visitants()
    {
        return $this->belongsTo(Visitant::class);
    }
}
