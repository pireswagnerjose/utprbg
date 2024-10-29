<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoconferenceHearingDocument extends Model
{
    use HasFactory;
    protected $table = 'videoconference_hearing_documents';
    protected $fillable = [
        'title',
        'path',
        'user_create_id',
        'user_update_id',
        'prison_unit_id',
        'pk_v_h_id',
    ];

    /**
     * Summary of videoconference_hearing
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function videoconference_hearing()
    {
        return $this->belongsTo(VideoconferenceHearing::class,  'pk_v_h_id', 'id');
    }
}
