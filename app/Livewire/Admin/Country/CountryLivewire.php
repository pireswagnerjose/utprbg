<?php

namespace App\Livewire\Admin\Country;

use App\Models\Admin\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("País")]
class CountryLivewire extends Component
{
    use WithPagination;
    
    // CLASS ACESSORIES
    public int $userCreate;
    public int $userUpdate;
    public $userPrisonUnitID;
    public function mount()
    {
        $this->userPrisonUnitID = Auth::user()->prison_unit_id;
        $this->userCreate = Auth::user()->id;
        $this->userUpdate = Auth::user()->id;
    }

    // SEARCH - PESQUISA
    #[Url]
    public $search;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    //ADD NEW - ADICIONAR NOVO 
    public $add_new;
    public function addNew()
    {
        $this->add_new = true;
    }
    public function cancel()
    {
        $this->add_new = false;
    }

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function clearFields()
    {
        $this->reset('country', 'userCreate');
        $this->confirmingCountryUpdate = false;
    }

    //CREATE NEW - CRIAR NOVO
    public $country;
    public function create()
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'country'           => $this->country,
                'prison_unit_id'    => $this->userPrisonUnitID,
                'user_create'       => $this->userCreate,
            ],
            // Validation rules to apply...
            [
                'country'           => 'required|max:100|string|unique:countries,country',
                'prison_unit_id'    => 'required|max:10',
                'user_create'       => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['country'] = mb_strtoupper ($dataValidated['country'],'utf-8');
        $dataValidated['user_create'] = mb_strtoupper ($dataValidated['user_create'],'utf-8');

        Country::create($dataValidated);
        $this->reset('country');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $confirmingCountryUpdate = false;
    public function modalCountryUpdate(Country $country)
    {
        $this->country  = $country->country;
        $this->confirmingCountryUpdate = $country->id;
    }

    // LEVEL ACCESS UPDATE
    public function updateCountry(Country $country)
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'country'       => $this->country,
                'user_update'   => $this->userUpdate,
            ],
            // Validation rules to apply...
            [
                'country'       => "required|max:100|string|unique:countries,country,{$country->id},id",//unico (usa o id da table pra validadar)
                'user_update'   => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['country'] = mb_strtoupper ($dataValidated['country'],'utf-8');
        $dataValidated['user_update'] = mb_strtoupper ($dataValidated['user_update'],'utf-8');

        $country->update($dataValidated);//atualiza os dados no banco
        $this->reset('country', 'userCreate');
        $this->confirmingCountryUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $confirmingCountryDeletion = false;
    public function modalCountryDeletion($countryID)
    {
        $this->confirmingCountryDeletion = $countryID;
    }
    // LEVEL ACCESS DELETE
    public function deleteCountry(Country $country)
    {
        $country->delete();
        $this->confirmingCountryDeletion = false;
    }
    public function render()
    {
        return view('livewire.admin.country.country-livewire', [
            'countries' => Country::latest()->where('country', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
