<?php

namespace App\Livewire\Forms;

use App\Models\Main\HearingWithPoliceOfficer;
use App\Models\Main\HearingWithPoliceOfficerDocument;
use App\Traits\HearingWithPoliceOfficerTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Form;
use Livewire\WithFileUploads;

class HearingWithPoliceOfficerForm extends Form
{
    use WithFileUploads;
    public ?HearingWithPoliceOfficer $hearing_with_police_officer_model;
    use HearingWithPoliceOfficerTrait;//propriedades da tabela
    
    public $prisoner_id;
    public $user_create;
    public $user_update;
    public $prison_unit_id;
    public $delegate;
    public $police_station;
    public $date_of_service;
    public $time_of_service;
    public $status;
    public $remark;
    public $modality_care_id;
    public $modality_cares = [];
    public $hearing_with_police_officer;
    public $statuses = [];

    // document
    public $pk_h_p_o_id;
    public $title;
    public $path;

    // reset fields
    public function clearFields()
    {
        $this->reset(
            'delegate', 'police_station', 'date_of_service', 'time_of_service', 'status', 'remark', 'modality_care_id',
            'pk_h_p_o_id', 'title', 'path',
        );
    }
    // create 
    public function create()
    {
        $data = $this->validate();
        $data['delegate']  = mb_strtoupper($data['delegate'], 'utf-8');
        $data['police_station']  = mb_strtoupper($data['police_station'], 'utf-8');
        $data['remark']  = mb_strtoupper($data['remark'], 'utf-8');
        HearingWithPoliceOfficer::create($data);
        $this->clearFields();
        session()->flash('success', 'Criado com sucesso.');
    }
    // set post
    public function setPost($hearing_with_police_officer)
    {
        $this->delegate = $hearing_with_police_officer->delegate;
        $this->police_station = $hearing_with_police_officer->police_station;
        $this->date_of_service = $hearing_with_police_officer->date_of_service;
        $this->time_of_service = $hearing_with_police_officer->time_of_service;
        $this->status = $hearing_with_police_officer->status;
        $this->remark = $hearing_with_police_officer->remark;
        $this->modality_care_id = $hearing_with_police_officer->modality_care_id;
        $this->user_update = Auth::user()->id;
        $this->prison_unit_id = Auth::user()->prison_unit_id;
        $this->prisoner_id = $hearing_with_police_officer->prisoner_id;
        $this->hearing_with_police_officer_model = $hearing_with_police_officer;
    }
    // update
    public function update($dataValidated)
    {
        $dataValidated['delegate']  = mb_strtoupper($dataValidated['delegate'], 'utf-8');
        $dataValidated['police_station']  = mb_strtoupper($dataValidated['police_station'], 'utf-8');
        $dataValidated['remark']  = mb_strtoupper($dataValidated['remark'], 'utf-8');
        $this->hearing_with_police_officer_model->update($dataValidated);
        $this->clearFields();
    }
    // delete 
    public function delete($hearing_with_police_officer)
    {
        $teste = HearingWithPoliceOfficerDocument::where('pk_h_p_o_id',$hearing_with_police_officer->id)->get()->first();
        if(!empty($teste))
        {
            return redirect()->back()->with('danger', 'Existe(m) documento(s) relacionado(s), você tem que excluí-lo(s) primeiro');  
        }else {
            $hearing_with_police_officer->delete();
            session()->flash('success', 'Excluído com sucesso.');
        }
    }
    // create document
    public function createDocument()
    {
        $data = $this->validate([
                'pk_h_p_o_id'       => 'required',
                'title'             => 'required|max:255',
                'path'              => 'required|mimetypes:application/pdf',
                'user_create'       => 'required|max:10',
                'prison_unit_id'    => 'required|max:10',
            ]);
        /* cria o nome do documento */
        $document_name = $data['title'].'-'.date('Y-m-d H:i:s');
        /* faz o upload e retorna o endereco do arquivo */
        $data['path'] = $this->path->storeAs('prisoner/'.$this->prisoner_id.'/documents'.'/legal_assistance', $document_name.'.'.$data['path']->getClientOriginalExtension());

        $data['title']  = mb_strtoupper($data['title'], 'utf-8');
        HearingWithPoliceOfficerDocument::create($data);
        $this->clearFields();
        session()->flash('success', 'Criado com sucesso.');
    }
    // delete document
    public function deleteDocument($deleteDocument)
    {
        /* responsável por excluir o arquivo */
        if (!empty($deleteDocument->path)) {
            Storage::disk('public')->delete($deleteDocument->path);
        }
        $deleteDocument->delete();
    }
}
