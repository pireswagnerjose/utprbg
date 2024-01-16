<?php

namespace App\Models\Admin\Prison;

use App\Models\Main\Prison;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrisonOrigin extends Model
{
    use HasFactory;
    protected $table    = 'prison_origins';
    protected $guarded  = [];

    public function prison()
    {
        return $this->hasMany(Prison::class);
    }
}
