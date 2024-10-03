<?php

namespace App\Livewire\Main\Visitant;

use App\Models\Admin\Sex;
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
    public $date_of_birth = '';
    public $photo = '';
    public $cpf = '';
    public $phone = '';
    public $status = '';
    public $remark = '';
    public $user_create = '';
    public $user_update= '';
    public $prison_unit_id = '';
    public $sex_id = '';

    public $sexes = [];

    public function mount()
    {   
        $this->prison_unit_id   = Auth::user()->prison_unit_id;
        $this->user_create      = Auth::user()->id;
        $this->user_update      = Auth::user()->id;
        $this->sexes            = Sex::all();
    }

    public function render()
    {
        $visitants = Visitant::orderBy('name', 'asc')
        ->where('name', 'like', "%{$this->name}%")
        ->where('date_of_birth', 'like', "%{$this->date_of_birth}%")
        ->where('cpf', 'like', "%{$this->cpf}%")
        ->where('phone', 'like', "%{$this->phone}%")
        ->where('status', 'like', "%{$this->status}%")
        ->where('sex_id', 'like', "%{$this->sex_id}%")
        ->paginate(9);

        return view('livewire.main.visitant.visitant-livewire', compact('visitants'));
    }
}
