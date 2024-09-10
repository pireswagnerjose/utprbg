<?php

namespace App\Livewire\Main\Visitant;

use App\Models\Main\Visitant;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

#[Layout("layouts.app")]
#[Title("Pesquisar Visitante")]
class VisitantLivewire extends Component
{
    use WithPagination;

    public $name = '';
    public $photo = '';
    public $cpf = '';
    public $address = '';
    public $phone = '';
    public $status = '';
    public $remark = '';
    public $user_create = '';
    public $user_update= '';
    public $prison_unit_id = '';

    public function mount()
    {   
        $this->prison_unit_id       = Auth::user()->prison_unit_id;
        $this->user_create          = Auth::user()->id;
        $this->user_update          = Auth::user()->id;
    }

    public function render()
    {
        $visitants = Visitant::orderBy('name', 'asc')
        ->where('name', 'like', "%{$this->name}%")
        ->where('cpf', 'like', "%{$this->cpf}%")
        ->where('phone', 'like', "%{$this->phone}%")
        ->where('address', 'like', "%{$this->address}%")
        ->where('status', 'like', "%{$this->status}%")
        ->paginate(9);

        return view('livewire.main.visitant.visitant-livewire', compact('visitants'));
    }
}
