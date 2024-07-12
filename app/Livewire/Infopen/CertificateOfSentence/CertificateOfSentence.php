<?php

namespace App\Livewire\Infopen\CertificateOfSentence;

use App\Models\Main\Prisoner;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Atestado de Pena")]
class CertificateOfSentence extends Component
{
    use WithPagination;
    public $start_date = '';
    public $end_date = '';
    
    public function render()
    {
        $prisoners = Prisoner::orderBy('name', 'asc');
        $prisoners = $prisoners->where('status_prison_id', '1');
        $prisoners = $prisoners->where('prison_unit_id', Auth::user()->prison_unit_id);
        $prisoners = $prisoners->whereRelation('prisons', 'sentence_certificate', '>=', $this->start_date);
        $prisoners = $prisoners->whereRelation('prisons', 'sentence_certificate', '<=', $this->end_date);
        $prisoners = $prisoners->paginate(9);
        return view('livewire.infopen.certificate-of-sentence.certificate-of-sentence', compact('prisoners'));
    }
}
