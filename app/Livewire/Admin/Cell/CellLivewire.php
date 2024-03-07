<?php

namespace App\Livewire\Admin\Cell;

use App\Models\Admin\Cell;
use App\Models\Admin\Ward;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Cela")]
class CellLivewire extends Component
{
    use WithPagination;
    
    // CLASS ACESSORIES
    public int $userCreate;
    public int $userUpdate;
    public $userPrisonUnitID;
    public $wardID;
    public $wards = [];
    public function mount()
    {
        $this->userPrisonUnitID = Auth::user()->prison_unit_id;
        $this->wards = Ward::where('prison_unit_id', $this->userPrisonUnitID)->get();
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
        $this->reset('cell', 'wardID');
        $this->confirmingCellUpdate = false;
    }

    //CREATE NEW - CRIAR NOVO
    public $cell;
    public function create()
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'cell'              => $this->cell,
                'ward_id'            => $this->wardID,
                'prison_unit_id'    => $this->userPrisonUnitID,
                'user_create'       => $this->userCreate,
            ],
            // Validation rules to apply...
            [
                'cell'              => 'required|max:100|string|unique:cells,cell',
                'ward_id'           => 'required|max:10',
                'prison_unit_id'    => 'required|max:10',
                'user_create'       => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['cell'] = mb_strtoupper ($dataValidated['cell'],'utf-8');
        $dataValidated['user_create'] = mb_strtoupper ($dataValidated['user_create'],'utf-8');

        Cell::create($dataValidated);
        $this->reset('cell', 'wardID');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $confirmingCellUpdate = false;
    public function modalCellUpdate(Cell $cell)
    {
        $this->cell  = $cell->cell;
        $this->wardID  = $cell->ward_id;
        $this->confirmingCellUpdate = $cell->id;
    }

    // UPDATE
    public function updateCell(Cell $cell)
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'cell'          => $this->cell,
                'ward_id'       => $this->wardID,
                'user_update'   => $this->userUpdate,
            ],
            // Validation rules to apply...
            [
                'cell'          => "required|max:100|string|unique:cells,cell,{$cell->id},id",//unico (usa o id da table pra validadar)
                'ward_id'       => 'required|max:10',
                'user_update'   => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['cell'] = mb_strtoupper ($dataValidated['cell'],'utf-8');
        $dataValidated['user_update'] = mb_strtoupper ($dataValidated['user_update'],'utf-8');

        $cell->update($dataValidated);//atualiza os dados no banco
        $this->reset('cell', 'wardID');
        $this->confirmingCellUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $confirmingCellDeletion = false;
    public function modalCellDeletion($cellID)
    {
        $this->confirmingCellDeletion = $cellID;
    }

    // DELETE
    public function deleteCell(Cell $cell)
    {
        $cell->delete();
        $this->confirmingCellDeletion = false;
    }
    
    public function render()
    {
        return view('livewire.admin.cell.cell-livewire', [
            'cells' => Cell::orderBy('cell', 'asc')
                    ->where('prison_unit_id', $this->userPrisonUnitID)
                    ->where('cell', 'like', "%{$this->search}%")
                    ->paginate(10)
        ]);
    }
}
