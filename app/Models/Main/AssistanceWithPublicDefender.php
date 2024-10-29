<?php

namespace App\Models\Main;

use App\Models\Admin\LegalAssistance\ModalityCare;
use App\Models\Admin\PublicDefender\PublicDefender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistanceWithPublicDefender extends Model
{
    use HasFactory;
    protected $table = 'assistance_with_public_defenders';
    protected $fillable = [
        'date_of_service',
        'time_of_service',
        'status',
        'remark',
        'user_create',
        'user_update',
        'prison_unit_id',
        'prisoner_id',
        'public_defender_id',
        'modality_care_id',
    ];

    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class);
    }
    public function public_defender()
    {
        return $this->belongsTo(PublicDefender::class);
    }
    public function modality_care()
    {
        return $this->belongsTo(ModalityCare::class);
    }

    public function assistance_with_public_defender_documents()
    {
        return $this->hasMany(AssistanceWithPublicDefenderDocument::class, 'pk_a_p_d_id', 'id');
    }
}
