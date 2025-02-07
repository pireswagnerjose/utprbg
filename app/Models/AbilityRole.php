<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbilityRole extends Model
{
    protected $table = "ability_role";
    protected $fillable = ['ability_id','role_id'] ;
}
