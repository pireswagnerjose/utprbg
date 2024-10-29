<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HearingWithPoliceOfficerDocument extends Model
{
    use HasFactory;
    protected $table = 'hearing_with_police_officer_documents';
    protected $fillable = [
        'title',
        'path',
        'user_create_id',
        'user_update_id',
        'prison_unit_id',
        'pk_h_p_o_id',
    ];

    /**
     * Summary of hearing_with_police_officer
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hearing_with_police_officer()
    {
        return $this->belongsTo(HearingWithPoliceOfficer::class, 'pk_h_p_o_id', 'id');
    }
}
