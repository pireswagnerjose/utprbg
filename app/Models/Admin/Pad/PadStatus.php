<?php

namespace App\Models\Admin\Pad;

use App\Models\Main\Pad;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PadStatus extends Model
{
    use HasFactory;
    protected $table    = 'pad_statuses';
    protected $guarded  = [];

    public function pads()
    {
        return $this->hasMany(Pad::class);
    }
}
