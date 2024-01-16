<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelAccess extends Model
{
    use HasFactory;
    protected $table    = 'level_accesses';
    protected $guarded  = [];
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
