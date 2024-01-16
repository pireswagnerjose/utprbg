<?php

namespace App\Models\Main;

use App\Models\Admin\InternalService\TypeService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalService extends Model
{
    use HasFactory;
    protected $table    = 'internal_services';
    protected $guarded  = [];

    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class);
    }

    public function type_service()
    {
        return $this->belongsTo(TypeService::class);
    }
}
