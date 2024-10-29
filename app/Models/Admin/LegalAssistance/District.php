<?php

namespace App\Models\Admin\LegalAssistance;

use App\Models\Main\VideoconferenceHearing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $table    = 'districts';
    protected $guarded  = [];

    /**
     * faz referência a tabela atendimento por vídeoconferência
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videoconference_hearings()
    {
        return $this->hasMany(VideoconferenceHearing::class);
    }
}
