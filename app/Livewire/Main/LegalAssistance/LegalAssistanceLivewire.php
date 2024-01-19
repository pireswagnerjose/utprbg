<?php

namespace App\Livewire\Main\LegalAssistance;

use App\Models\Admin\LegalAssistance\CriminalCourt;
use App\Models\Admin\LegalAssistance\District;
use App\Models\Admin\LegalAssistance\Lawyer;
use App\Models\Admin\LegalAssistance\ModalityCare;
use App\Models\Admin\LegalAssistance\TypeCare;
use App\Models\Main\LegalAssistance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class LegalAssistanceLivewire extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $prisoner_id;
    public $user_create;
    public $user_update;
    public $prison_unit_id;
    public $date;
    public $time;
    public $status = '';
    public $document;
    public $remark = '';
    public $type_care_id = '';
    public $modality_care_id = '';
    public $lawyer_id = '';
    public $district_id = '';
    public $criminal_court_id = '';
    public $type_cares = [];
    public $modality_cares = [];
    public $lawyers = [];
    public $districts = [];
    public $criminal_courts = [];

    public $statuses = ['MANTIDO', 'CANCELADO'];

    public function mount()
    {
        $this->user_create     =Auth::user()->id;
        $this->user_update     =Auth::user()->id;
        $this->prison_unit_id  =Auth::user()->prison_unit_id;
        $this->type_cares      =TypeCare::all();
        $this->modality_cares  =ModalityCare::all();
        $this->lawyers         =Lawyer::all();
        $this->districts       =District::all();
        $this->criminal_courts =CriminalCourt::all();
    }

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function clearFields()
    {
        $this->reset('date', 'time', 'status', 'document', 'remark', 'type_care_id', 'modality_care_id',
        'lawyer_id','district_id','criminal_court_id');
    }

    // CLOSE MODAL
    public function closeModal()
    {
        $this->openModalLegalAssistanceCreate = false;
        $this->openModalLegalAssistanceUpdate = false;
        $this->openModalLegalAssistanceDelete = false;
    }

    // Transforma os caracteres em maiusculos
    public function convertUppercase($dataValidated)
    {
        $dataValidated['status'] = mb_strtoupper ($dataValidated['status'],'utf-8');
        $dataValidated['remark'] = mb_strtoupper ($dataValidated['remark'],'utf-8');
        return $dataValidated;
    }

    // MODAL CREATE
    public $openModalLegalAssistanceCreate = false;
    public function modalLegalAssistanceCreate()
    {
        $this->openModalLegalAssistanceCreate = true;
    }
    // CREATE
    public function legalAssistanceCreate()
    {
        $dataValidated = $this->validate(
            [
                'document' => [
                    'nullable',
                    File::types(['pdf']),
                ],
                'date'             =>'required|max:255',
                'time'             =>'nullable|max:255',
                'status'           =>'nullable|max:255',
                'remark'           =>'nullable',
                'user_create'      =>'required|max:10',
                'prison_unit_id'   =>'required|max:10',
                'prisoner_id'      =>'required|max:10',
                'type_care_id'     =>'required|max:10',
                'modality_care_id' =>'required|max:10',
                'lawyer_id'        =>'nullable|max:10',
                'district_id'      =>'nullable|max:10',
                'criminal_court_id'=>'nullable|max:10',
                ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);
        if ($this->document) {
            /* responsável por excluir o documento */
            if (!empty($dataValidated->document)) {
                Storage::disk('public')->delete($dataValidated->document);
            }
            /* cria o nome com a extensão */
            $document = date('d-m-Y_H-m-s') . '.' . $this->document->getClientOriginalExtension();
            /* faz o upload e retorna o endereco do arquivo */
            $dataValidated['document'] = $this->document->storeAs('prisoner/'. $this->prisoner_id .'/documents/legal_assistance', $document);
        }
        // grava os dados no banco
        LegalAssistance::create($dataValidated);
        $this->closeModal();
        $this->clearFields();
        $this->resetPage();
    }

    // MODAL UPDATE
    public $openModalLegalAssistanceUpdate = false;
    public function modalLegalAssistanceUpdate(LegalAssistance $legal_assistance)
    {
        $this->date                            =$legal_assistance->date;
        $this->time                            =$legal_assistance->time;
        $this->status                          =$legal_assistance->status;
        $this->remark                          =$legal_assistance->remark;
        $this->type_care_id                    =$legal_assistance->type_care_id;
        $this->modality_care_id                =$legal_assistance->modality_care_id;
        $this->prison_unit_id                  =$legal_assistance->prison_unit_id;
        $this->lawyer_id                       =$legal_assistance->lawyer_id;
        $this->district_id                     =$legal_assistance->district_id;
        $this->criminal_court_id               =$legal_assistance->criminal_court_id;
        $this->openModalLegalAssistanceUpdate  =$legal_assistance->id;
    }
    // UPDATE
    public function legalAssistanceUpdate(LegalAssistance $legal_assistance)
    {
        if ($this->document) {
            $dataValidated = $this->validate(
                [
                    'document' => [
                        'nullable',
                        File::types(['pdf']),
                    ],
                    'date'             =>'required|max:255',
                    'time'             =>'nullable|max:255',
                    'status'           =>'nullable|max:255',
                    'remark'           =>'nullable',
                    'user_update'      =>'required|max:10',
                    'type_care_id'     =>'required|max:10',
                    'modality_care_id' =>'required|max:10',
                    'lawyer_id'        =>'nullable|max:10',
                    'district_id'      =>'nullable|max:10',
                    'criminal_court_id'=>'nullable|max:10',
                ]
            );
        } else {
            $dataValidated = $this->validate(
                [
                    'date'             =>'required|max:255',
                    'time'             =>'nullable|max:255',
                    'status'           =>'nullable|max:255',
                    'remark'           =>'nullable',
                    'user_update'      =>'required|max:10',
                    'type_care_id'     =>'required|max:10',
                    'modality_care_id' =>'required|max:10',
                    'lawyer_id'        =>'nullable|max:10',
                    'district_id'      =>'nullable|max:10',
                    'criminal_court_id'=>'nullable|max:10',
                ]
            );
        }
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);
        if ($this->document) {
            /* responsável por excluir o documento */
            if (!empty($dataValidated->document)) {
                Storage::disk('public')->delete($dataValidated->document);
            }
            /* cria o nome com a extensão */
            $document = date('d-m-Y_H-m-s') . '.' . $this->document->getClientOriginalExtension();
            /* faz o upload e retorna o endereco do arquivo */
            $dataValidated['document'] = $this->document->storeAs('prisoner/'. $this->prisoner_id .'/documents/legal_assistance', $document);
        }
        // corrige o erro quando o campo for deixado vazio
        $lawyer = $dataValidated['lawyer_id'] ?: null;
        $dataValidated['lawyer_id'] = $lawyer;
        $district = $dataValidated['district_id'] ?: null;
        $dataValidated['district_id'] = $district;
        $criminal_court = $dataValidated['criminal_court_id'] ?: null;
        $dataValidated['criminal_court_id'] = $criminal_court;
        // grava os dados no banco
        $legal_assistance->update($dataValidated);
        $this->closeModal();
        $this->clearFields();
        $this->resetPage();
    }

    // MODAL DELETE 
    public $openModalLegalAssistanceDelete = false;
    public function modalLegalAssistanceDelete($legal_assistance_id)
    {
        $this->openModalLegalAssistanceDelete = $legal_assistance_id;
    }
    // DELETE
    public function legalAssistanceDelete(LegalAssistance $legal_assistance)
    {
        /* responsável por excluir o documento */
        if (!empty($legal_assistance->document)) {
            Storage::disk('public')->delete($legal_assistance->document);
        }
        $legal_assistance->delete();
        $this->closeModal();
        $this->clearFields();
    }
    
    public function render()
    {
        return view('livewire.main.legal-assistance.legal-assistance-livewire', [
            'legal_assistances' => LegalAssistance::where('prisoner_id', $this->prisoner_id)->orderBy('date','desc')->paginate(10),
        ]);
    }
}
