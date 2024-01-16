<?php

namespace App\Models\Main;

use App\Models\Admin\Prison\OutputType;
use App\Models\Admin\Prison\PrisonOrigin;
use App\Models\Admin\Prison\TypePrison;
use App\Models\Admin\PrisonUnit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prison extends Model
{
    use HasFactory;
    protected $table    = 'prisons';
    protected $guarded  = [];

    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class);
    }

    public function prison_unit()
    {
        return $this->belongsTo(PrisonUnit::class);
    }

    public function prison_origin()
    {
        return $this->belongsTo(PrisonOrigin::class);
    }

    public function type_prison()
    {
        return $this->belongsTo(TypePrison::class);
    }

    public function output_type()
    {
        return $this->belongsTo(OutputType::class);
    }

    public function prison_documents()
    {
        return $this->hasMany(PrisonDocument::class);
    }
}
