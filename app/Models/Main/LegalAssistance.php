<?php

namespace App\Models\Main;

use App\Models\Admin\LegalAssistance\CriminalCourt;
use App\Models\Admin\LegalAssistance\District;
use App\Models\Admin\LegalAssistance\Lawyer;
use App\Models\Admin\LegalAssistance\ModalityCare;
use App\Models\Admin\LegalAssistance\TypeCare;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalAssistance extends Model
{
    use HasFactory;
    protected $table    = 'legal_assistances';
    protected $guarded   = [];

    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class);
    }

    public function type_care()
    {
        return $this->belongsTo(TypeCare::class);
    }

    public function modality_care()
    {
        return $this->belongsTo(ModalityCare::class);
    }

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function criminal_court()
    {
        return $this->belongsTo(CriminalCourt::class);
    }
}
