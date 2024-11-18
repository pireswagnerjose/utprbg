<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $table = 'photos';
    protected $fillable = [
        'photo',
        'position',
        'description',
        'user_create',
        'user_update',
        'prison_unit_id',
        'prisoner_id',
    ];

    /**
     * Faz o relacionamento com a tabela Preso
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class);
    }
}
