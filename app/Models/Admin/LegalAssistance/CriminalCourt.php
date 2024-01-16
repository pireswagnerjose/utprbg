<?php

namespace App\Models\Admin\LegalAssistance;

use App\Models\Main\LegalAssistance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriminalCourt extends Model
{
    use HasFactory;
    protected $table = 'criminal_courts';
    protected $guarded = [];

    public function legal_assistances()
    {
        return $this->hasMany(LegalAssistance::class);
    }
}
