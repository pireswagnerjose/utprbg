<?php

namespace App\Livewire\Admin\LegalAssistance\District;

use App\Models\Admin\LegalAssistance\District;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Comarca")]
class DistrictLivewire extends Component
{
    use WithPagination;
    // CLASS ACESSORIES
    public int $user_create;
    public int $user_update;
    public $prison_unit_id;
    public $district = '';

    public function mount()
    {
        $this->prison_unit_id   = Auth::user()->prison_unit_id;
        $this->user_create      = Auth::user()->id;
        $this->user_update      = Auth::user()->id;
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
    public function closeModal()
    {
        $this->openModalDistrictUpdate = false;
        $this->openModalDistrictDelete = false;
    }

    //CREATE NEW - CRIAR NOVO
    public function districtCreate()
    {
        $dataValidated = $this->validate(
            [
                'district'      =>'required|max:100|unique:districts,district',
                'user_create'   =>'required|max:10',
                'prison_unit_id'=>'required|max:10',
            ]
        );

        // Transforma os caracteres em maiusculos
        $dataValidated['district'] = mb_strtoupper ($dataValidated['district'],'utf-8');

        District::create($dataValidated);
        $this->reset('district');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $openModalDistrictUpdate = false;
    public function modalDistrictUpdate(District $district)
    {
        $this->district               = $district->district;
        $this->openModalDistrictUpdate= $district->id;
    }
    // UPDATE
    public function districtUpdate(District $district)
    {
        $dataValidated = $this->validate(
            [
                'district'   =>"required|max:100|unique:districts,district,{$district->id},id",
                'user_update'=>'required|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated['district'] = mb_strtoupper ($dataValidated['district'],'utf-8');

        $district->update($dataValidated);//atualiza os dados no banco
        $this->reset('district');
        $this->openModalDistrictUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $openModalDistrictDelete = false;
    public function modalDistrictDelete($district)
    {
        $this->openModalDistrictDelete = $district;
    }
    // LEVEL ACCESS DELETE
    public function districtDelete(District $district)
    {
        $district->delete();
        $this->openModalDistrictDelete = false;
    }
    
    public function render()
    {
        return view('livewire.admin.legal-assistance.district.district-livewire', [
            'districts' => District::orderBy('district', 'asc')->where('district', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
