<?php

namespace App\Models\Main;

use App\Models\Admin\LegalAssistance\CriminalCourt;
use App\Models\Admin\LegalAssistance\District;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoconferenceHearing extends Model
{
    use HasFactory;

    protected $table = 'videoconference_hearings';
    protected $fillable = [
        'date_of_service',
        'time_of_service',
        'status',
        'remark',
        'user_create',
        'user_update',
        'prison_unit_id',
        'prisoner_id',
        'district_id',
        'criminal_court_id',
        'modality_care_id',
    ];

    /**
     * referencia a tabela preso
     * $prisoner_id
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class);
    }

    /**
     * referencia a tabela comarca da audiência
     * $district_id
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * referencia a tabela vara criminal
     * $criminal_court_id
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function criminal_court()
    {
        return $this->belongsTo(CriminalCourt::class);
    }

    /**
     * Summary of videoconference_hearing_documents
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videoconference_hearing_documents()
    {
        return $this->hasMany(VideoconferenceHearingDocument::class,  'pk_v_h_id', 'id');
    }
}
