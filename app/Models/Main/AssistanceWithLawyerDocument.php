<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistanceWithLawyerDocument extends Model
{
    use HasFactory;
    protected $table = 'assistance_with_lawyer_documents';
    protected $fillable = [
        'title',
        'path',
        'user_create_id',
        'user_update_id',
        'prison_unit_id',
        'pk_a_w_l_id',
    ];

    /**
     * Retorna o relacionamento com a tabela Tipo do Atendimento
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assistance_with_lawyer()
    {
        return $this->belongsTo(AssistanceWithLawyer::class, 'pk_a_w_l_id', 'id');
    }
}
