<?php

namespace App\Models\Main;

use App\Models\Admin\LegalAssistance\ModalityCare;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HearingWithPoliceOfficer extends Model
{
    use HasFactory;
    protected $table = 'hearing_with_police_officers';
    protected $fillable = [
        'delegate',
        'police_station',
        'date_of_service',
        'time_of_service',
        'status',
        'remark',
        'user_create',
        'user_update',
        'prison_unit_id',
        'prisoner_id',
        'modality_care_id',
    ];

    /**
     * faz referência a tabela preso
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class);
    }
    
    /**
     * faz referência a tabela Modalidade do Atendimento
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modality_care()
    {
        return $this->belongsTo(ModalityCare::class);
    }

    /**
     * Summary of hearing_with_police_officer_documents
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hearing_with_police_officer_documents()
    {
        return $this->hasMany(HearingWithPoliceOfficerDocument::class, 'pk_h_p_o_id', 'id');
    }
}
