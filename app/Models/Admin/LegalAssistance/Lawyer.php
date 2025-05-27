<?php

namespace App\Models\Admin\LegalAssistance;

use App\Models\Main\AssistanceWithLawyer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lawyer extends Model
{
    use HasFactory;
    protected $table = 'lawyers';
    protected $guarded = [];

    public function assistance_with_lawyers()
    {
        return $this->hasMany(AssistanceWithLawyer::class);
    }
}
