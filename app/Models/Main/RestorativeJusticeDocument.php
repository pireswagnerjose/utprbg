<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestorativeJusticeDocument extends Model
{
    use HasFactory;
    protected $table = 'restorative_justice_documents';
    protected $fillable = [
        'title',
        'path',
        'user_create_id',
        'user_update_id',
        'prison_unit_id',
        'restorative_justice_id',
    ];

    /**
     * Summary of hearing_with_police_officer
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function restorative_justice()
    {
        return $this->belongsTo(RestorativeJustice::class,  'restorative_justice_id', 'id');
    }
}
