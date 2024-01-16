<?php

namespace App\Models\Main;

use App\Models\Admin\ExternalOutput\ExitReason;
use App\Models\Admin\ExternalOutput\Requesting;
use App\Models\Admin\Municipality;
use App\Models\Admin\PrisonUnit;
use App\Models\Admin\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalExit extends Model
{
    use HasFactory;
    protected $table    = 'external_exits';
    protected $guarded  = [];

    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function prison_unit()
    {
        return $this->belongsTo(PrisonUnit::class);
    }

    public function exit_reason()
    {
        return $this->belongsTo(ExitReason::class);
    }

    public function requesting()
    {
        return $this->belongsTo(Requesting::class);
    }
}
