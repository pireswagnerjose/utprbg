<?php

namespace App\Models\Admin\Process;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessRegime extends Model
{
    use HasFactory;
    protected $table    = 'process_regimes';
    protected $guarded  = [];

    public function processes()
    {
        // return $this->hasMany(Process::class);
    }
}
