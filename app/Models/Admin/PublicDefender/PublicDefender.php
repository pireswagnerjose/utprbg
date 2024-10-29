<?php

namespace App\Models\Admin\PublicDefender;

use App\Models\Main\AssistanceWithPublicDefender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicDefender extends Model
{
    use HasFactory;
    protected $table = 'public_defenders';
    protected $fillable = [
        'public_defender',
        'contact',
        'user_create',
        'user_update',
        'prison_unit_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * retorna o relacionamento com a tabela assistencia com a defensoria pública
     */
    public function assistance_with_public_defenders()
    {
        return $this->hasMany(AssistanceWithPublicDefender::class);
    }
}
