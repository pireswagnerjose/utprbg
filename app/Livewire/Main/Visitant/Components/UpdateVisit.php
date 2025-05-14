<?php

namespace App\Livewire\Main\Visitant\Components;

use App\Models\Main\Visit\VisitScheduling;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Reactive;

class UpdateVisit extends Component
{
    #[Reactive]
    public $visitant_id;

    /** Faz a edição na visita agendada */
    public $visitScheduling_date_visit;
    public $visitScheduling_visitant_name;
    public $visitScheduling_prisoner_name;
    public $visitScheduling_type;
    public $visitScheduling_status;
    public $visitScheduling_remark;
    public $openModalVisitUpdate = false;

    public $visit_schedulings = [];

    public $visitScheduling_id;

    public function mount()
    {
        $this->visit_schedulings = VisitScheduling::where('visitant_id', $this->visitant_id)->get();
    }

    public function closeModalVisitUpdate()
    {
        $this->openModalVisitUpdate = false;
        $this->reset(
            'visitScheduling_date_visit',
            'visitScheduling_type',
            'visitScheduling_status',
            "visitScheduling_remark",
            "visitScheduling_id"
        );
    }
    public function modalVisitUpdate(VisitScheduling $visitScheduling)
    {
        $this->visitScheduling_id = $visitScheduling->id;
        $this->visitScheduling_date_visit = $visitScheduling->date_visit;
        $this->visitScheduling_visitant_name = $visitScheduling->visitant->name;
        $this->visitScheduling_prisoner_name = $visitScheduling->prisoner->name;
        $this->visitScheduling_type = $visitScheduling->type;
        $this->visitScheduling_status = $visitScheduling->status;
        $this->visitScheduling_remark = $visitScheduling->remark;
        $this->openModalVisitUpdate = $visitScheduling->id;
    }

    public function updateVisit(VisitScheduling $visitScheduling)
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'status' => $this->visitScheduling_status,
                'remark' => $this->visitScheduling_remark,
                'user_update' => Auth::user()->id,
            ],
            // Validation rules to apply...
            [
                'status' => 'required',
                'remark' => 'nullable',
                'user_update' => 'max:10',
            ],
            // Messages...
            [
                'status' => 'O campo status é obrigatório'
            ]
        )->validate();
        $dataValidated['remark'] = mb_strtoupper($dataValidated['remark'], 'utf-8');

        $dataValidated['status'] = $dataValidated['status'] === "1" ? true : false;
        $visitScheduling = VisitScheduling::find($this->visitScheduling_id);

        $visitScheduling->update($dataValidated);
        $this->closeModalVisitUpdate();
    }

    public function render()
    {
        $this->mount();
        return view('livewire.main.visitant.components.update-visit');
    }
}
