<?php

namespace App\Models\Admin\Prison;

use App\Models\Main\Prison;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePrison extends Model
{
    use HasFactory;
    protected $table    = 'type_prisons';
    protected $guarded  = [];

    public function prison()
    {
        return $this->hasMany(Prison::class);
    }
}
