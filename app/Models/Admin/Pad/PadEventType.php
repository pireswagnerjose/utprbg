<?php

namespace App\Models\Admin\Pad;

use App\Models\Main\Pad;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PadEventType extends Model
{
    use HasFactory;
    protected $table    = 'pad_event_types';
    protected $guarded  = [];

    public function pads()
    {
        return $this->hasMany(Pad::class);
    }
}
