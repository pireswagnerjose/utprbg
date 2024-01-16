<?php

namespace App\Models\Admin\Prison;

use App\Models\Main\Prisoner;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPrison extends Model
{
    use HasFactory;
    protected $table    = 'status_prisons';
    protected $guarded  = [];

    public function prisons()
    {
        return $this->hasMany(Prisoner::class);
    }
    public function prison()
    {
        // return $this->hasMany(Prison::class);
    }
}
