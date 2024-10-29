<?php

namespace App\Models\Main;

use App\Models\Admin\CivilStatus;
use App\Models\Admin\Country;
use App\Models\Admin\EducationLevel;
use App\Models\Admin\Ethnicity;
use App\Models\Admin\Municipality;
use App\Models\Admin\Prison\StatusPrison;
use App\Models\Admin\Sex;
use App\Models\Admin\SexualOrientation;
use App\Models\Admin\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prisoner extends Model
{
    use HasFactory;
    protected $table    = 'prisoners';
    protected $guarded  = [];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function ethnicity()
    {
        return $this->belongsTo(Ethnicity::class);
    }

    public function sexual_orientation()
    {
        return $this->belongsTo(SexualOrientation::class);
    }

    public function education_level()
    {
        return $this->belongsTo(EducationLevel::class);
    }

    public function civil_status()
    {
        return $this->belongsTo(CivilStatus::class);
    }

    public function sex()
    {
        return $this->belongsTo(Sex::class);
    }
    
    public function status_prison()
    {
        return $this->belongsTo(StatusPrison::class);
    }

    public function prisons()
    {
        return $this->hasMany(Prison::class);
    }

    public function processes()
    {
        return $this->hasMany(Process::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function internal_services()
    {
        return $this->hasMany(InternalService::class);
    }

    public function external_exits()
    {
        return $this->hasMany(ExternalExit::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function unit_address()
    {
        return $this->hasMany(UnitAddress::class);
    }

    /**
     * faz referência a tabela atendimento com advogados
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assistance_with_lawyers()
    {
        return $this->hasMany(AssistanceWithLawyer::class);
    }

    /**
     * faz referência a tabela atendimento com a defensoria pública
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assistance_with_public_defenders()
    {
        return $this->hasMany(AssistanceWithPublicDefender::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * faz referência a tabela atendimento com a justiça restaurativa
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
