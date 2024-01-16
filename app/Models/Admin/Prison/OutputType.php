<?php

namespace App\Models\Admin\Prison;

use App\Models\Main\Prison;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutputType extends Model
{
    use HasFactory;
    protected $table    = 'output_types';
    protected $guarded  = [];

    public function prison()
    {
        return $this->hasMany(Prison::class);
    }
}
