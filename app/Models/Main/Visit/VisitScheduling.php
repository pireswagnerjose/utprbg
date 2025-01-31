<?php

namespace App\Models\Main\Visit;

use App\Models\Main\IdentificationCard;
use App\Models\Main\Prisoner;
use App\Models\Main\Visitant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitScheduling extends Model
{
    use HasFactory;
    protected $table = 'visit_schedulings';
    protected $fillable = [
        'date_visit',
        'type',
        'status',
        'remark',
        'user_create',
        'user_update',
        'prison_unit_id',
        'identification_card_id',
        'prisoner_id',
        'visitant_id',
    ];

    /**
     * faz o relacionamento com a tabela do preso
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class);
    }

    /**
     * faz o relacionamento com a tabela do visitante
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function visitant()
    {
        return $this->belongsTo(Visitant::class);
    }

    /**
     * faz o relacionamento com a tabela do cartão de identificação do visitante
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function identification_card()
    {
        return $this->belongsTo(IdentificationCard::class);
    }
}
