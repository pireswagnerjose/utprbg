<?php

namespace App\Livewire\Forms;

use App\Models\Main\AssistanceWithPublicDefender;
use App\Models\Main\AssistanceWithPublicDefenderDocument;
use App\Traits\AssistanceWithPublicDefenderTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Form;

class AssistanceWithPublicDefenderForm extends Form
{
    public ?AssistanceWithPublicDefender $assistance_with_public_defender_model;
    use AssistanceWithPublicDefenderTrait;
    public $prisoner_id;
    public $user_create;
    public $user_update;
    public $prison_unit_id;
    public $date_of_service;
    public $time_of_service;
    public $status;
    public $remark;
    public $public_defender_id;
    public $modality_care_id;

    // document
    public $pk_a_p_d_id;
    public $title;
    public $path;

    // reset fields
    public function clearFields()
    {
        $this->reset(
            'date_of_service', 'time_of_service', 'status', 'remark', 'public_defender_id', 'modality_care_id',
            'pk_a_p_d_id', 'title', 'path',
        );
    }
    // create 
    public function create()
    {
        $data = $this->validate();
        $data['remark']  = mb_strtoupper($data['remark'], 'utf-8');
        AssistanceWithPublicDefender::create($data);
        $this->clearFields();
        session()->flash('success', 'Criado com sucesso.');
    }
    // set post
    public function setPost($assistance_with_public_defender)
    {
        $this->date_of_service = $assistance_with_public_defender->date_of_service;
        $this->time_of_service = $assistance_with_public_defender->time_of_service;
        $this->status = $assistance_with_public_defender->status;
        $this->remark = $assistance_with_public_defender->remark;
        $this->public_defender_id = $assistance_with_public_defender->public_defender_id;
        $this->modality_care_id = $assistance_with_public_defender->modality_care_id;
        $this->user_update = Auth::user()->id;
        $this->prison_unit_id = Auth::user()->prison_unit_id;
        $this->prisoner_id = $assistance_with_public_defender->prisoner_id;
        $this->assistance_with_public_defender_model = $assistance_with_public_defender;
    }
    // update
    public function update($dataValidated)
    {
        $dataValidated['remark']  = mb_strtoupper($dataValidated['remark'], 'utf-8');
        $this->assistance_with_public_defender_model->update($dataValidated);
        $this->clearFields();
    }
    // delete 
    public function delete($assistance_with_public_defender)
    {
        $teste = AssistanceWithPublicDefenderDocument::where('pk_a_p_d_id',$assistance_with_public_defender->id)->get()->first();
        if(!empty($teste))
        {
            return redirect()->back()->with('danger', 'Existe(m) documento(s) relacionado(s), você tem que excluí-lo(s) primeiro');  
        }else {
            $assistance_with_public_defender->delete();
            session()->flash('success', 'Excluído com sucesso.');
        }
    }
    // create document
    public function createDocument()
    {
        $data = $this->validate([
                'pk_a_p_d_id'       => 'required',
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
        AssistanceWithPublicDefenderDocument::create($data);
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
