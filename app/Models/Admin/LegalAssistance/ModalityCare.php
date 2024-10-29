<?php

namespace App\Models\Admin\LegalAssistance;

use App\Models\Main\AssistanceWithLawyer;
use App\Models\Main\AssistanceWithPublicDefender;
use App\Models\Main\HearingWithPoliceOfficer;
use App\Models\Main\RestorativeJustice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModalityCare extends Model
{
    use HasFactory;
    protected $table    = 'modality_cares';
    protected $guarded  = [];

    /**
     * faz referência a tabela atendimento com advogado
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assistance_with_lawyers()
    {
        return $this->hasMany(AssistanceWithLawyer::class);
    }

    /**
     * faz referência a tabela atendimento com a  defensoria pública
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assistance_with_public_defenders()
    {
        return $this->hasMany(AssistanceWithPublicDefender::class);
    }

    /**
     * faz referência a tabela atendimento com a justiça restaurativa
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function restorative_justices()
    {
        return $this->hasMany(RestorativeJustice::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * faz referência a tabela oitiva com o delegado
     */
    public function hearing_with_police_officers()
    {
        return $this->hasMany(HearingWithPoliceOfficer::class);
    }
}
