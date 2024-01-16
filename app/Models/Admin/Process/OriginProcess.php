<?php

namespace App\Models\Admin\Process;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OriginProcess extends Model
{
    use HasFactory;
    protected $table    = 'origin_processes';
    protected $guarded  = [];

    public function processes()
    {
        // return $this->hasMany(Process::class);
    }
}
