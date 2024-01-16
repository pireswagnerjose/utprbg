<?php

namespace App\Models\Main;

use App\Models\Admin\PrisonUnit;
use App\Models\Admin\Process\PenalType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenalTypeProcess extends Model
{
    use HasFactory;
    protected $table = 'penal_type_process';
    protected $fillable = [
        'process_id', 'penal_type_id', 'prisoner_id', 'prison_unit_id', 'user_create', 'user_update',
    ];

    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class);
    }

    public function prison_unit()
    {
        return $this->belongsTo(PrisonUnit::class);
    }

    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    public function penal_type()
    {
        return $this->belongsTo(PenalType::class);
    }
}
