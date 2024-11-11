<?php

namespace App\Livewire\Main\Visit\VisitControl;

use App\Models\Admin\Ward;
use App\Models\Main\Visit\VisitControl;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VisitControlLivewire extends Component
{
    public $date;
    public $number_visit;
    public $visist_type;
    public $ward_id;
    public $user_create;
    public $user_update;
    public $prison_unit_id;
    public $wards = [];
    public $visit_types = ['SOCIAL','ÍNTIMA'];
    public $openModalCreate = false;
    public $openModalUpdate = false;
    public $openModalDelete = false;

    public function mount()
    {
        $this->user_create = Auth::user()->id;
        $this->user_update = Auth::user()->id;
        $this->prison_unit_id = Auth::user()->prison_unit_id;
        $this->wards = Ward::all();
    }

    /**
     * limpa os campos do formulário
     * @return void
     */
    public function clearFields()
    {
        $this->reset( 'date', 'number_visit', 'visist_type', 'ward_id' );
    }

    /**
     * fecha os modais e e chama a funçao para limpar os campos do formulário
     * @return void
     */
    public function closeModal()
    {
        $this->openModalCreate = false;
        $this->openModalUpdate = false;
        $this->openModalDelete = false;
        $this->clearFields();
    }

    /**
     * abre o modal para cadastrar um novo período
     * @return void
     */
    public function modalCreate()
    {
        $this->openModalCreate = true;
    }

    /**
     * Cadastra um novo controle de visista
     * @return void
     */
    public function create()
    {
        $data = $this->validate([
            'date'              => 'required|max:10|min:10',
            'number_visit'      => 'required|max:255',
            'visist_type'       => 'required|max:255',
            'ward_id'           => 'required|max:10',
            'user_create'       => 'required|max:10',
            'prison_unit_id'    => 'required|max:10',
        ]);
        VisitControl::create($data);
        $this->closeModal();
        $this->redirectRoute('visit-control.index');
        session()->flash('success', 'Cadastrado com sucesso.');
    }

    /**
     * Abre o modal para edição
     * @param \App\Models\Main\Visit\VisitControl $visit_control
     * @return void
     */
    public function modalUpdate(VisitControl $visit_control)
    {
        $this->date             = $visit_control->date;
        $this->number_visit     = $visit_control->number_visit;
        $this->visist_type      = $visit_control->visist_type;
        $this->ward_id          = $visit_control->ward_id;
        $this->openModalUpdate  = $visit_control->id;
    }

    /**
     * Atualiza o dado
     * @param \App\Models\Main\Visit\VisitControl $visit_control
     * @return void
     */
    public function update(VisitControl $visit_control)
    {
        $data = $this->validate([
            'date'              => 'required|max:10|min:10',
            'number_visit'      => 'required|max:255',
            'visist_type'       => 'required|max:255',
            'ward_id'           => 'required|max:10',
            'user_update'       => 'required|max:10',
            'prison_unit_id'    => 'required|max:10',
        ]);
        $visit_control->update($data);
        $this->closeModal();
        $this->redirectRoute('visit-control.index');
        session()->flash('success', 'Atualizado com sucesso.');
    }

    /**
     * abre o modal para a confirmaçao da exclusão
     * @param mixed $visit_control_id
     * @return void
     */
    public function modalDelete($visit_control_id)
    {
        $this->openModalDelete = $visit_control_id;
    }

    /**
     * Exclui o dado
     * @param \App\Models\Main\Visit\VisitControl $visit_control
     * @return void
     */
    public function delete(VisitControl $visit_control)
    {
        $visit_control->delete();
        $this->redirectRoute('visit-control.index');
        session()->flash('error', 'Exluído com sucesso.');
    }

    public function render()
    {
        $visit_controls = VisitControl::orderBy('date', 'desc')->paginate(10);
        return view('livewire.main.visit.visit-control.visit-control-livewire',
        compact('visit_controls')
        );
    }
}
