<?php

namespace App\Livewire\Pages\UnitAddress;

use App\Models\Admin\Cell;
use App\Models\Admin\PrisonUnit;
use App\Models\Admin\Ward;
use App\Models\Main\Prisoner;
use App\Models\Main\UnitAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class UnitAddressLivewire extends Component
{
    public $prisoner_id;

    public $date;
    public $status;
    public $prison_unit_id;
    public $ward_id;
    public $cell_id;
    public $prison_unit;
    public $user_create;
    public $user_update;
    public $wards;
    public $cells;
    public $unitAddressUpdate;
    public $openModal = false;

    public function mount()
    {
        $this->user_create      = Auth::user()->id;
        $this->user_update      = Auth::user()->id;
        $this->prison_unit_id   = PrisonUnit::find(Auth::user()->prison_unit_id)->id;
        $this->wards            = Ward::all();
    }

    public function cell()
    {
        $this->cells = Cell::where('ward_id', $this->ward_id)->get();
    }

    public function closeModal()
    {
        $this->reset('date', 'status', 'ward_id', 'cell_id');
        $this->openModal = false;
    }

    public function modal(Prisoner $prisoner)
    {
        $this->openModal = $prisoner->id;
    }

    public function save(Prisoner $prisoner)
    {
        $this->status = "ATIVO";
        // Quando mudar de cela
        if($this->unitAddressUpdate = UnitAddress::where('prisoner_id', $this->prisoner_id)->where('status', 'ATIVO')->first()){
            $updateStatus = 'INATIVO';
            $updateDataValidated = Validator::make(
                // Data to validate...
                [
                    'status'            => $updateStatus,
                    'user_update'       => $this->user_update,
                ],
                // Validation rules to apply...
                [
                    'status'            => 'required|max:100',
                    'user_update'       => 'max:10',
                ],
            )->validate();
            
            $this->unitAddressUpdate->update($updateDataValidated);
        } 
        
        // nova cela
        $createDataValidated = $this->validate(
            [
                'date'              => 'required|max:100',
                'status'            => 'required|max:100',
                'prison_unit_id'    => 'required|max:10',
                'ward_id'           => "required|max:10",
                'cell_id'           => "required|max:10",
                'prisoner_id'       => "required|max:10",
                'user_create'       => 'max:10',
            ],
        );
        
        $created = UnitAddress::create($createDataValidated);
        $this->closeModal();
        $this->redirectRoute('prisoners.show', ['prisoner_id' => $this->prisoner_id]);
        if ($created) {
            session()->flash('success', 'A Localização do Preso na Unidade foi criada com sucesso!');
        }
        else{
            session()->flash('error', 'Não foi possível criar a Localização do Presos na Unidade, por favor tente novamente.');
        }
    }

    public function render()
    {
        $unitAddress = UnitAddress::where('prisoner_id', $this->prisoner_id)
            ->where("status", "ATIVO")->first();
        return view('livewire.pages.unit-address.unit-address-livewire', compact('unitAddress'));
    }
}
