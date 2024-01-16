<?php

namespace App\Models\Main;

use App\Models\Admin\Process\OriginProcess;
use App\Models\Admin\Process\PenalType;
use App\Models\Admin\Process\ProcessRegime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory;
    protected $table    = 'processes';
    protected $guarded  = [];
    
    // relations
    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class);
    }

    public function origin_process()
    {
        return $this->belongsTo(OriginProcess::class);
    }

    public function process_regime()
    {
        return $this->belongsTo(ProcessRegime::class);
    }

    public function penal_type()
    {
        return $this->belongsToMany(PenalType::class);
    }

    public function penal_type_processes()
    {
        return $this->hasMany(PenalTypeProcess::class);
    }

    public function process_documents()
    {
        return $this->hasMany(ProcessDocument::class);
    }
}
