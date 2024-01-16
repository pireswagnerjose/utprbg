<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrisonDocument extends Model
{
    use HasFactory;
    protected $table    = 'prison_documents';
    protected $guarded  = [];

    public function prison()
    {
        return $this->belongsTo(Prison::class);
    }
}
