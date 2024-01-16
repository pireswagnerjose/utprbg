<?php

namespace App\Models\Admin\ExternalOutput;

use App\Models\Main\ExternalExit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExitReason extends Model
{
    use HasFactory;
    protected $table = 'exit_reasons';
    protected $guarded = [];

    public function external_exits()
    {
        return $this->hasMany(ExternalExit::class);
    }
}
