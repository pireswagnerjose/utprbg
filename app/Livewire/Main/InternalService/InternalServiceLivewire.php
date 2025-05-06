<?php

namespace App\Livewire\Main\InternalService;

use App\Models\Admin\InternalService\TypeService;
use App\Models\Main\InternalService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class InternalServiceLivewire extends Component
{
    use WithPagination;
    public $prisoner_id;
    public $user_create;
    public $user_update;
    public $prison_unit_id;
    public $date;
    public $time;
    public $status;
    public $remark = '';
    public $type_service_id;
    public $type_services = [];
    public $statuses = ['MANTIDO', 'CANCELADO'];

    public function mount()
    {
        $this->user_create = Auth::user()->id;
        $this->user_update = Auth::user()->id;
        $this->prison_unit_id = Auth::user()->prison_unit_id;
        $this->type_services = TypeService::all();
    }

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function clearFields()
    {
        $this->reset('date', 'time', 'status', 'remark', 'type_service_id');
    }

    // CLOSE MODAL
    public function closeModal()
    {
        $this->openModalInternalServiceCreate = false;
        $this->openModalInternalServiceUpdate = false;
        $this->openModalInternalServiceDelete = false;
    }

    // Transforma os caracteres em maiusculos
    public function convertUppercase($dataValidated)
    {
        $dataValidated['status'] = mb_strtoupper($dataValidated['status'], 'utf-8');
        $dataValidated['remark'] = mb_strtoupper($dataValidated['remark'], 'utf-8');
        return $dataValidated;
    }

    // MODAL CREATE
    public $openModalInternalServiceCreate = false;
    public function modalInternalServiceCreate()
    {
        $this->openModalInternalServiceCreate = true;
    }
    // CREATE
    public function internalServiceCreate()
    {
        $dataValidated = $this->validate(
            [
                'date' => 'required|min:10|max:10',
                'time' => 'nullable|max:255',
                'status' => 'nullable|max:255',
                'remark' => 'nullable',
                'user_create' => 'required|max:10',
                'prison_unit_id' => 'required|max:10',
                'prisoner_id' => 'required|max:10',
                'type_service_id' => 'required|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);
        // grava os dados no banco
        InternalService::create($dataValidated);
        $this->closeModal();
        $this->clearFields();
        $this->resetPage();
    }

    // MODAL UPDATE
    public $openModalInternalServiceUpdate = false;
    public function modalInternalServiceUpdate(InternalService $internal_service)
    {
        $this->date = $internal_service->date;
        $this->time = $internal_service->time;
        $this->status = $internal_service->status;
        $this->remark = $internal_service->remark;
        $this->type_service_id = $internal_service->type_service_id;
        $this->openModalInternalServiceUpdate = $internal_service->id;
    }
    // UPDATE
    public function internalServiceUpdate(InternalService $internal_service)
    {
        $dataValidated = $this->validate(
            [
                'date' => 'required|min:10|max:10',
                'time' => 'nullable|max:255',
                'status' => 'nullable|max:255',
                'remark' => 'nullable',
                'user_update' => 'required|max:10',
                'type_service_id' => 'required|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);
        // grava os dados no banco
        $internal_service->update($dataValidated);
        $this->closeModal();
        $this->clearFields();
        $this->resetPage();
    }

    // MODAL DELETE 
    public $openModalInternalServiceDelete = false;
    public function modalInternalServiceDelete($internal_service_id)
    {
        $this->openModalInternalServiceDelete = $internal_service_id;
    }
    // DELETE
    public function internalServiceDelete(InternalService $internal_service)
    {
        $internal_service->delete();
        $this->closeModal();
        $this->clearFields();
    }

    public function render()
    {
        return view('livewire.main.internal-service.internal-service-livewire', [
            'internal_services' => InternalService::where('prisoner_id', $this->prisoner_id)->orderBy('date', 'desc')->paginate(10)
        ]);
    }
}
