<?php

namespace App\Livewire\Infopen\CriminalTypes;

use App\Models\Admin\Process\PenalType;
use App\Models\Main\PenalTypeProcess;
use App\Models\Main\Prisoner;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Tipos Penais")]
class CriminalTypes extends Component
{
    use WithPagination;
    public $penal_types = [];
    public $penal_type_processes = [];
    public $penal_type_id = '';

    public function mount()
    {
        $this->penal_types = PenalType::orderBy('created_at', 'asc')->get();
    }

    public function penal_type_fun()
    {
        $this->penal_type_processes = PenalTypeProcess::where('penal_type_id', $this->penal_type_id)->get();
    }
    public function render()
    {
        $penal_type_processes = [];
        foreach ( $this->penal_type_processes as $key) {
            $penal_type_processes[] = $key->prisoner_id;
        }
        $prisoners = Prisoner::orderBy('name', 'asc');
        $prisoners = Prisoner::whereIn('id', $penal_type_processes);
        $prisoners = $prisoners->paginate(9);
        return view('livewire.infopen.criminal-types.criminal-types', compact('prisoners'));
    }
}
