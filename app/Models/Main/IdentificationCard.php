<?php

namespace App\Models\Main;

use App\Models\Admin\Family\DegreeOfKinship;
use App\Models\Main\Visit\VisitScheduling;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentificationCard extends Model
{
    use HasFactory;
    protected $table    = 'identification_cards';
    protected $guarded  = [];

    /**
     * faz o relacionamento com a tabela preso
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class);
    }

    /**
     * faz o relacionamento com a tablea visitante
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function visitant()
    {
        return $this->belongsTo(Visitant::class);
    }

    /**
     * faz o relacionamento com a table grau de parentesco
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function degree_of_kinship()
    {
        return $this->belongsTo(DegreeOfKinship::class);
    }

    /**
     * faz o relacionamento com a tabela agendamento de visitas
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function visit_schedulings()
    {
        return $this->hasMany(VisitScheduling::class);
    }
}
