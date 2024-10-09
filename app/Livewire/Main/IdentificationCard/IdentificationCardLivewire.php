<?php

namespace App\Livewire\Main\IdentificationCard;

use App\Models\Admin\Family\DegreeOfKinship;
use App\Models\Main\IdentificationCard;
use App\Models\Main\Prisoner;
use App\Models\Main\Visitant;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class IdentificationCardLivewire extends Component
{
    use WithFileUploads;
    public $prisoners = [];
    public $visitants = [];
    public $degree_of_kinships = [];
    public $user_create = '';
    public $user_update= '';
    public $prison_unit_id = '';
    public $visitant_id = '';
    public $prisoner_id = '';
    public $date_of_creation = '';
    public $expiration_date = '';
    public $type = '';
    public $status = '';
    public $remark = '';
    public $degree_of_kinship_id = '';

    public function mount()
    {
        $this->prison_unit_id       = Auth::user()->prison_unit_id;
        $this->user_create          = Auth::user()->id;
        $this->user_update          = Auth::user()->id;
        $this->prisoners            = Prisoner::all();
        $this->visitants            = Visitant::all();
        $this->visitants            = Visitant::all();
        $this->degree_of_kinships   = DegreeOfKinship::all();
    }
    public function render()
    {
        $identification_cards = IdentificationCard::orderBy('created_at', 'asc')
        ->with('visitant', 'prisoner')
        ->where('visitant_id', 'like', "%{$this->visitant_id}%")
        ->where('prisoner_id', 'like', "%{$this->prisoner_id}%")
        ->paginate(9);

        return view('livewire.main.identification-card.identification-card-livewire', compact('identification_cards'));
    }

    // CLOSE MODAL
    public function closeModal()
    {
        $this->openModalIdentificationCardCreate = false;
        // $this->openIdentificationCardUpdate = false;
        // $this->openIdentificationCardDelete = false;
        $this->redirectRoute('identification-card.index');
    }

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function clearFields()
    {
        $this->reset('date_of_creation','expiration_date','type','status','remark',
            'prisoner_id','visitant_id','degree_of_kinship_id');
    }

    // Transforma os caracteres em maiusculos
    public function convertUppercase($dataValidated)
    {
        $dataValidated['type'] = mb_strtoupper ($dataValidated['type'],'utf-8');
        $dataValidated['status'] = mb_strtoupper ($dataValidated['status'],'utf-8');
        $dataValidated['remark'] = mb_strtoupper ($dataValidated['remark'],'utf-8');
        return $dataValidated;
    }

    // MODAL CREATE NEW
    public $openModalIdentificationCardCreate = false;
    public function modalIdentificationCardCreate()
    {
        $this->clearFields();
        $this->openModalIdentificationCardCreate = true;
    }

    // CREATE NEW
    public function identificationCardCreate()
    {
        $dataValidated = $this->validate(
            [
                'date_of_creation'      =>'nullable|min:10|max:10',
                'expiration_date'       =>'nullable|min:10|max:10',
                'type'                  =>'required|max:255',
                'status'                =>'required|max:255',
                'remark'                =>'nullable',
                'visitant_id'           =>'required|max:10',
                'prisoner_id'           =>'required|max:10',
                'degree_of_kinship_id'  =>'required|max:10',
                'user_create'           =>'required|max:10',
                'prison_unit_id'        =>'required|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);
        // Grava os dados no banco
        IdentificationCard::create($dataValidated);
        $this->openModalIdentificationCardCreate = false;
        $this->clearFields();
        $identification_card_id = IdentificationCard::orderBy('created_at', 'desc')->first()->id;
        $this->redirectRoute('identification-card.show', ['identification_card_id' => $identification_card_id]);
    }
}
