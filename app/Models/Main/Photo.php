<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $table    = 'photos';
    protected $guarded  = [];

    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class);
    }
}
