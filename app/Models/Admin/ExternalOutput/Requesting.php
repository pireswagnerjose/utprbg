<?php

namespace App\Models\Admin\ExternalOutput;

use App\Models\Main\ExternalExit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requesting extends Model
{
    use HasFactory;
    protected $table    = 'requestings';
    protected $guarded  = [];

    public function external_exits()
    {
        return $this->hasMany(ExternalExit::class);
    }
}
