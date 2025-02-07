<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = ['title', 'functionality'];

    public function abilities()
    {
        return $this->hasMany(Ability::class);
    }
}
