<?php

namespace App\Models\Main;

use App\Models\Admin\Pad\PadEventType;
use App\Models\Admin\Pad\PadLocal;
use App\Models\Admin\Pad\PadNatureOfEvent;
use App\Models\Admin\Pad\PadStatus;
use App\Models\Admin\Pad\PadTypeOfOccurrence;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pad extends Model
{
    use HasFactory;
    protected $table    = 'pads';
    protected $guarded  = [];

    public function pad_event_type()
    {
        return $this->belongsTo(PadEventType::class);
    }

    public function pad_local()
    {
        return $this->belongsTo(PadLocal::class);
    }

    public function pad_nature_of_event()
    {
        return $this->belongsTo(PadNatureOfEvent::class);
    }

    public function pad_status()
    {
        return $this->belongsTo(PadStatus::class);
    }

    public function pad_type_of_occurrence()
    {
        return $this->belongsTo(PadTypeOfOccurrence::class);
    }

    public function pad_documents()
    {
        return $this->hasMany(PadDocument::class);
    }
}
