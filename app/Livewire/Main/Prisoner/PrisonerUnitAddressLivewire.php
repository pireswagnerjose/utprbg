<?php

namespace App\Livewire\Main\Prisoner;

use App\Models\Admin\Cell;
use App\Models\Admin\PrisonUnit;
use App\Models\Admin\Ward;
use App\Models\Main\Prisoner;
use App\Models\Main\UnitAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class PrisonerUnitAddressLivewire extends Component
{
    public $prisoner_id;

    public $date;
    public $status = '';
    public $prison_unit_id;
    public $ward_id;
    public $cell_id;
    public $prison_unit;
    public $user_create = '';
    public $user_update = '';
    public $wards;
    public $cells;
    public $unitAddressUpdate = '';

    public function mount()
    {
        $this->user_create      = Auth::user()->id;
        $this->user_update      = Auth::user()->id;
        $this->prison_unit_id   = PrisonUnit::find(Auth::user()->prison_unit_id)->id;
        $this->wards            = Ward::all();
        $this->cells            = Cell::all();
    }

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function clearFields()
    {
        $this->openModalUnitAddress = false;
    }

    // MODAL
    public $openModalUnitAddress = false;
    public function modalUnitAddress(Prisoner $prisoner)
    {
        $this->openModalUnitAddress = $prisoner->id;
    }

    public function unitAddress(Prisoner $prisoner)
    {
        $this->status = "ATIVO";

        // Quando mudar de cela
        if($this->unitAddressUpdate = UnitAddress::where('prisoner_id', $this->prisoner_id)->where('status', 'ATIVO')->first()){
            $updateStatus = 'INATIVO';
            $dataValidated = Validator::make(
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
            $this->unitAddressUpdate->update($dataValidated);
        }
        $dataValidated = $this->validate(
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
        $dataValidated['date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $dataValidated['date'])->format('Y-m-d');
        UnitAddress::create($dataValidated);
        $this->openModalUnitAddress = false;
        $this->reset('date', 'status', 'prison_unit_id', 'ward_id', 'cell_id');
    }

    public function render()
    {
        return view('livewire.main.prisoner.prisoner-unit-address-livewire', [
            'unitAddress' => UnitAddress::where('prisoner_id', 'like', "%{$this->prisoner_id}%")
                            ->where("status","=", "ATIVO")->first()
        ]);
    }
}
