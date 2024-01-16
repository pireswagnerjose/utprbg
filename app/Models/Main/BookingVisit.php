<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingVisit extends Model
{
    use HasFactory;
    protected $table    = 'booking_visits';
    protected $guarded  = [];

    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class);
    }

    public function family()
    {
        return $this->belongsTo(Family::class); 
    }
}
