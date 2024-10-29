<?php

namespace App\Livewire\Forms;

use App\Models\Main\AssistanceWithLawyer;
use App\Models\Main\AssistanceWithLawyerDocument;
use App\Traits\AssistanceWithLawyerTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Form;
use Livewire\WithFileUploads;

class AssistanceWithLawyerForm extends Form
{
    use WithFileUploads;
    public ?AssistanceWithLawyer $assistance_with_lawyer_model;
    use AssistanceWithLawyerTrait;//propriedades da tabela atendimento com advogado
    
    public $prisoner_id;
    public $user_create;
    public $user_update;
    public $prison_unit_id;
    public $date_of_service;
    public $time_of_service;
    public $status;
    public $remark;
    public $lawyer_id;
    public $modality_care_id;
    public $lawyers = [];
    public $modality_cares = [];
    public $assistance_with_lawyer;
    public $statuses = [];

    // document
    public $pk_a_w_l_id;
    public $title;
    public $path;

    // reset fields
    public function clearFields()
    {
        $this->reset(
            'date_of_service', 'time_of_service', 'status', 'remark', 'lawyer_id', 'modality_care_id',
            'pk_a_w_l_id', 'title', 'path',
        );
    }
    // create 
    public function create()
    {
        $data = $this->validate();
        $data['remark']  = mb_strtoupper($data['remark'], 'utf-8');
        AssistanceWithLawyer::create($data);
        $this->clearFields();
        session()->flash('success', 'Criado com sucesso.');
    }
    // set post
    public function setPost($assistance_with_lawyer)
    {
        $this->date_of_service = $assistance_with_lawyer->date_of_service;
        $this->time_of_service = $assistance_with_lawyer->time_of_service;
        $this->status = $assistance_with_lawyer->status;
        $this->remark = $assistance_with_lawyer->remark;
        $this->lawyer_id = $assistance_with_lawyer->lawyer_id;
        $this->modality_care_id = $assistance_with_lawyer->modality_care_id;
        $this->user_update = Auth::user()->id;
        $this->prison_unit_id = Auth::user()->prison_unit_id;
        $this->prisoner_id = $assistance_with_lawyer->prisoner_id;
        $this->assistance_with_lawyer_model = $assistance_with_lawyer;
    }
    // update
    public function update($dataValidated)
    {
        $dataValidated['remark']  = mb_strtoupper($dataValidated['remark'], 'utf-8');
        $this->assistance_with_lawyer_model->update($dataValidated);
        $this->clearFields();
    }
    // delete 
    public function delete($assistance_with_lawyer)
    {
        $teste = AssistanceWithLawyerDocument::where('pk_a_w_l_id',$assistance_with_lawyer->id)->get()->first();
        if(!empty($teste))
        {
            return redirect()->back()->with('danger', 'Existe(m) documento(s) relacionado(s), você tem que excluí-lo(s) primeiro');  
        }else {
            $assistance_with_lawyer->delete();
            session()->flash('success', 'Excluído com sucesso.');
        }
    }
    // create document
    public function createDocument()
    {
        $data = $this->validate([
                'pk_a_w_l_id'       => 'required',
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
        AssistanceWithLawyerDocument::create($data);
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
