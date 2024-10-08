<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingVisit extends Model
{
    use HasFactory;
    protected $table    = 'booking_visits';
    protected $guarded  = [];

    public function prisoners()
    {
        return $this->belongsTo(Prisoner::class);
    }
    public function visitants()
    {
        return $this->belongsTo(Visitant::class);
    }
}
