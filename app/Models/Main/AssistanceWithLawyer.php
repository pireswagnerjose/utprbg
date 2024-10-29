<?php

namespace App\Models\Main;

use App\Models\Admin\LegalAssistance\Lawyer;
use App\Models\Admin\LegalAssistance\ModalityCare;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistanceWithLawyer extends Model
{
    use HasFactory;
    protected $table = 'assistance_with_lawyers';
    protected $fillable = [
        'date_of_service',
        'time_of_service',
        'status',
        'remark',
        'user_create',
        'user_update',
        'prison_unit_id',
        'prisoner_id',
        'lawyer_id',
        'modality_care_id',
    ];

    /**
     * retorna o relacionamento com a tabela preso
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class);
    }

    /**
     * retorna o relacionamento com a tablea advogado
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }

    /**
     * Retorna o relacionamento com a tabela Tipo do Atendimento
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modality_care()
    {
        return $this->belongsTo(ModalityCare::class);
    }

    /**
     * Retorna o relacionamento com a tabela Tipo do Atendimento
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assistance_with_lawyer_documents()
    {
        return $this->hasMany(AssistanceWithLawyerDocument::class, 'pk_a_w_l_id', 'id');
    }
}
