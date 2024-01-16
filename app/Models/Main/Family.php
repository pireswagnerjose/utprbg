<?php

namespace App\Models\Main;

use App\Models\Admin\Family\DegreeOfKinship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;
    protected $table    = 'families';
    protected $guarded  = [];

    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class);
    }

    public function degree_of_kinship()
    {
        return $this->belongsTo(DegreeOfKinship::class);
    }

    public function booking_visits()
    {
        // return $this->hasMany(BookingVisit::class);
    }
}
