<?php

namespace App\Models\Admin\InternalService;

use App\Models\Main\InternalService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeService extends Model
{
    use HasFactory;
    protected $table    = 'type_services';
    protected $guarded  = [];

    public function internal_services()
    {
        return $this->hasMany(InternalService::class);
    }
}
