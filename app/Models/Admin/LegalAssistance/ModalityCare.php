<?php

namespace App\Models\Admin\LegalAssistance;

use App\Models\Main\LegalAssistance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModalityCare extends Model
{
    use HasFactory;
    protected $table    = 'modality_cares';
    protected $guarded  = [];

    public function legal_assistances()
    {
        return $this->hasMany(LegalAssistance::class);
    }
}
