<?php

namespace App\Models\Admin\Process;

use App\Models\Main\PenalTypeProcess;
use App\Models\Main\Process;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenalType extends Model
{
    use HasFactory;
    protected $table    = 'penal_types';
    protected $guarded  = [];

    public function processes()
    {
        return $this->belongsToMany(Process::class);
    }

    public function penal_type_processes()
    {
        return $this->hasMany(PenalTypeProcess::class);
    }
}
