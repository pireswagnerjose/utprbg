<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PadDocument extends Model
{
    use HasFactory;
    protected $table    = 'pad_documents';
    protected $guarded  = [];

    public function pad()
    {
        return $this->belongsTo(Pad::class);
    }
}
