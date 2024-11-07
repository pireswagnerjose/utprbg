<?php

namespace App\Livewire\Main\Visit\VisitSchedulingDate;

use App\Models\Main\Visit\VisitSchedulingDate;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class VisitSchedulingDateLivewire extends Component
{
    use WithPagination;
    public $start_date;
    public $end_date;
    public $user_create;
    public $user_update;
    public $prison_unit_id;
    public $openModalCreate = false;
    public $openModalUpdate = false;
    public $openModalDelete = false;

    public function mount()
    {
        $this->user_create = Auth::user()->id;
        $this->user_update = Auth::user()->id;
        $this->prison_unit_id = Auth::user()->prison_unit_id;
    }

    /**
     * limpa os campos do formulário
     * @return void
     */
    public function clearFields()
    {
        $this->reset( 'start_date', 'end_date' );
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
     * Cadastra um novo período
     * @return void
     */
    public function create()
    {
        $data = $this->validate([
            'start_date'        => 'required|max:10|min:10',
            'end_date'          => 'required|max:10|min:10',
            'user_create'       => 'required|max:10',
            'prison_unit_id'    => 'required|max:10',
        ]);
        VisitSchedulingDate::create($data);
        $this->closeModal();
        $this->redirectRoute('visit-scheduling-date.index');
        session()->flash('success', 'Cadastrado com sucesso.');
    }

    public function modalUpdate(VisitSchedulingDate $visit_scheduling_date)
    {
        $this->start_date = $visit_scheduling_date->start_date;
        $this->end_date   = $visit_scheduling_date->end_date;
        $this->openModalUpdate = $visit_scheduling_date->id;
    }

    public function update(VisitSchedulingDate $visit_scheduling_date)
    {
        $data = $this->validate([
            'start_date'        => 'required|max:10|min:10',
            'end_date'          => 'required|max:10|min:10',
            'user_update'       => 'required|max:10',
            'prison_unit_id'    => 'required|max:10',
        ]);
        $visit_scheduling_date->update($data);
        $this->closeModal();
        $this->redirectRoute('visit-scheduling-date.index');
        session()->flash('success', 'Atualizado com sucesso.');
    }

    /**
     * abre o modal para a confirmaçao da exclusão
     * @param mixed $visit_scheduling_date_id
     * @return void
     */
    public function modalDelete($visit_scheduling_date_id)
    {
        $this->openModalDelete = $visit_scheduling_date_id;
    }

    /**
     * Exclui o período de marcação da visita
     * @param \App\Models\Main\Visit\VisitSchedulingDate $visit_scheduling_date
     * @return void
     */
    public function delete(VisitSchedulingDate $visit_scheduling_date)
    {
        $visit_scheduling_date->delete();
        $this->redirectRoute('visit-scheduling-date.index');
        session()->flash('danger', 'Exluído com sucesso.');
    }

    
    public function render()
    {
        $visit_scheduling_dates = VisitSchedulingDate::orderBy('start_date', 'desc')->paginate(10);
        return view('livewire.main.visit.visit-scheduling-date.visit-scheduling-date-livewire',
        compact('visit_scheduling_dates')
        );
    }
}
