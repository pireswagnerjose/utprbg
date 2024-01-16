<?php

namespace App\Models\Admin\Pad;

use App\Models\Main\Pad;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PadTypeOfOccurrence extends Model
{
    use HasFactory;
    protected $table    = 'pad_type_of_occurrences';
    protected $guarded  = [];

    public function pads()
    {
        return $this->hasMany(Pad::class);
    }
}
