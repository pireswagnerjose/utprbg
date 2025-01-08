<?php

namespace App\Models\Main;

use App\Models\Admin\CivilStatus;
use App\Models\Admin\Municipality;
use App\Models\Admin\Sex;
use App\Models\Admin\State;
use App\Models\Main\Visit\VisitScheduling;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitant extends Model
{
    use HasFactory;
    protected $table    = 'visitants';
    protected $guarded  = [];

    public function civil_status()
    {
        return $this->belongsTo(CivilStatus::class);
    }

    public function sex()
    {
        return $this->belongsTo(Sex::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function identification_cards()
    {
        return $this->hasMany(IdentificationCard::class);
    }
    
    public function visitant_documents()
    {
        return $this->hasMany(VisitantDocument::class);
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
