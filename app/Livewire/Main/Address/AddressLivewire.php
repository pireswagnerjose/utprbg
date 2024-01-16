<?php

namespace App\Livewire\Main\Address;

use App\Models\Admin\Municipality;
use App\Models\Admin\State;
use App\Models\Main\Address;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class AddressLivewire extends Component
{
    use WithPagination;
    public $prisoner_id;
    public $user_create;
    public $user_update;
    public $prison_unit_id;

    public $street = '';
    public $number = '';
    public $complement = '';
    public $barrio = '';
    public $remark = '';
    public $municipality_id = '';
    public $state_id = '';
    public $municipalities = [];
    public $states = [];

    public $municipalityEdit = [];

    public function mount()
    {
        $this->user_create      = Auth::user()->id;
        $this->user_update      = Auth::user()->id;
        $this->prison_unit_id   = Auth::user()->prison_unit_id;
        $this->states           = State::all();
    }
    // Seleciona o município conforme o estado escolhido
    public function selectMunicipality()
    {
        $this->municipalities = Municipality::where('state_id', $this->state_id)->get();
    }

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function clearFields()
    {
        $this->reset('street', 'number', 'complement', 'barrio', 'remark', 'municipality_id', 'state_id');
    }

    // CLOSE MODAL
    public function closeModal()
    {
        $this->openModalAddressCreate = false;
        $this->openModalAddressUpdate = false;
        $this->openModalAddressDelete = false;
    }

    // Transforma os caracteres em maiusculos
    public function convertUppercase($dataValidated)
    {
        $dataValidated['street'] = mb_strtoupper ($dataValidated['street'],'utf-8');
        $dataValidated['number'] = mb_strtoupper ($dataValidated['number'],'utf-8');
        $dataValidated['complement'] = mb_strtoupper ($dataValidated['complement'],'utf-8');
        $dataValidated['barrio'] = mb_strtoupper ($dataValidated['barrio'],'utf-8');
        $dataValidated['remark'] = mb_strtoupper ($dataValidated['remark'],'utf-8');
        return $dataValidated;
    }

    // MODAL CREATE
    public $openModalAddressCreate = false;
    public function modalAddressCreate()
    {
        $this->openModalAddressCreate = true;
    }
    // CREATE
    public function addressCreate()
    {
        $dataValidated = $this->validate(
            [
                'street'            =>'required|max:255',
                'number'            =>'nullable|max:255',
                'complement'        =>'nullable|max:255',
                'barrio'            =>'nullable|max:100',
                'remark'            =>'nullable',
                'user_create'       =>'required|max:10',
                'prison_unit_id'    =>'required|max:10',
                'prisoner_id'       =>'required|max:10',
                'municipality_id'   =>'required|max:10',
                'state_id'          =>'required|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);
        // grava os dados no banco
        Address::create($dataValidated);
        $this->openModalAddressCreate = false;
        $this->clearFields();
        $this->resetPage();
    }

    // MODAL UPDATE
    public $openModalAddressUpdate = false;
    public function modalAddressUpdate(Address $address)
    {
        $this->municipalityEdit  = Municipality::find($address->municipality_id);
        $this->street            =$address->street;
        $this->number            =$address->number;
        $this->complement        =$address->complement;
        $this->barrio            =$address->barrio;
        $this->remark            =$address->remark;
        $this->municipality_id   =$address->municipality_id;
        $this->state_id          =$address->state_id;
        $this->openModalAddressUpdate = $address->id;
    }
    // UPDATE
    public function addressUpdate(Address $address)
    {
        $dataValidated = $this->validate(
            [
                'street'            =>'required|max:255',
                'number'            =>'nullable|max:255',
                'complement'        =>'nullable|max:255',
                'barrio'            =>'nullable|max:100',
                'remark'            =>'nullable',
                'user_update'       =>'required|max:10',
                'prisoner_id'       =>'required|max:10',
                'municipality_id'   =>'required|max:10',
                'state_id'          =>'required|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);
        // grava os dados no banco
        $address->update($dataValidated);
        $this->openModalAddressUpdate = false;
        $this->clearFields();
        $this->resetPage();
    }

    // MODAL DELETE 
    public $openModalAddressDelete = false;
    public function modalAddressDelete($address_id)
    {
        $this->openModalAddressDelete = $address_id;
    }
    // DELETE
    public function addressDelete(Address $address)
    {
        $address->delete();
        $this->closeModal();
        $this->clearFields();
    }

    public function render()
    {
        return view('livewire.main.address.address-livewire', [
            'addresses' => Address::where('prisoner_id', $this->prisoner_id)->orderBy('created_at', 'desc')->paginate(10)
        ]);
    }
}
