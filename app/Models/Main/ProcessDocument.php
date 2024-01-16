<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessDocument extends Model
{
    use HasFactory;
    protected $table    = 'process_documents';
    protected $guarded  = [];

    public function process()
    {
        return $this->belongsTo(Process::class);
    }
}
