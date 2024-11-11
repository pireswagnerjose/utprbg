<?php

namespace App\Models\Main\Visit;

use App\Models\Admin\Ward;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitControl extends Model
{
    use HasFactory;
    protected $table = 'visit_controls';
    protected $fillable = [
        'date',
        'number_visit',
        'visist_type',
        'user_create',
        'user_update',
        'prison_unit_id',
        'ward_id',
    ];

    /**
     * faz o relacionamento com a tablea ala/pavilhão
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }
}
