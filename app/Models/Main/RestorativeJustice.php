<?php

namespace App\Models\Main;

use App\Models\Admin\LegalAssistance\ModalityCare;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestorativeJustice extends Model
{
    use HasFactory;
    protected $table = 'restorative_justices';
    protected $fillable = [
        'facilitator_conciliator',
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
     * Summary of restorative_justice_documents
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function restorative_justice_documents()
    {
        return $this->hasMany(RestorativeJusticeDocument::class,  'restorative_justice_id', 'id');
    }
}
