<?php

namespace App\Models\Admin\LegalAssistance;

use App\Models\Main\VideoconferenceHearing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriminalCourt extends Model
{
    use HasFactory;
    protected $table = 'criminal_courts';
    protected $guarded = [];

    /**
     * faz referência a tabela atendimento por vídeoconferência
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videoconference_hearings()
    {
        return $this->hasMany(VideoconferenceHearing::class);
    }
}
