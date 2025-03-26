<?php

namespace App\Livewire\Forms;

use App\Models\Main\RestorativeJustice;
use App\Models\Main\RestorativeJusticeDocument;
use App\Traits\RestorativeJusticeTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Form;
use Livewire\WithFileUploads;

class RestorativeJusticeForm extends Form
{
    use WithFileUploads;
    public ?RestorativeJustice $restorative_justice_model;
    use RestorativeJusticeTrait;//propriedades da tabela

    public $prisoner_id;
    public $user_create;
    public $user_update;
    public $prison_unit_id;
    public $facilitator_conciliator;
    public $date_of_service;
    public $time_of_service;
    public $status;
    public $remark;
    public $modality_care_id;
    public $modality_cares = [];
    public $restorative_justice;
    public $statuses = [];

    // document
    public $restorative_justice_id;
    public $title;
    public $path;

    // reset fields
    public function clearFields()
    {
        $this->reset(
            'facilitator_conciliator',
            'date_of_service',
            'time_of_service',
            'status',
            'remark',
            'modality_care_id',
            'restorative_justice_id',
            'title',
            'path',
        );
    }
    // create 
    public function create()
    {
        $data = $this->validate();
        $data['facilitator_conciliator'] = mb_strtoupper($data['facilitator_conciliator'], 'utf-8');
        // $data['remark']  = mb_strtoupper($data['remark'], 'utf-8');
        RestorativeJustice::create($data);
        $this->clearFields();
        session()->flash('success', 'Criado com sucesso.');
    }
    // set post
    public function setPost($restorative_justice)
    {
        $this->restorative_justice = $restorative_justice->restorative_justice;
        $this->facilitator_conciliator = $restorative_justice->facilitator_conciliator;
        $this->date_of_service = $restorative_justice->date_of_service;
        $this->time_of_service = $restorative_justice->time_of_service;
        $this->status = $restorative_justice->status;
        $this->remark = $restorative_justice->remark;
        $this->modality_care_id = $restorative_justice->modality_care_id;
        $this->user_update = Auth::user()->id;
        $this->prison_unit_id = Auth::user()->prison_unit_id;
        $this->prisoner_id = $restorative_justice->prisoner_id;
        $this->restorative_justice_model = $restorative_justice;
    }
    // update
    public function update($dataValidated)
    {
        $dataValidated['facilitator_conciliator'] = mb_strtoupper($dataValidated['facilitator_conciliator'], 'utf-8');
        // $dataValidated['remark']  = mb_strtoupper($dataValidated['remark'], 'utf-8');
        $this->restorative_justice_model->update($dataValidated);
        $this->clearFields();
    }
    // delete 
    public function delete($restorative_justice)
    {
        $teste = RestorativeJusticeDocument::where('restorative_justice_id', $restorative_justice->id)->get()->first();
        if (!empty($teste)) {
            return redirect()->back()->with('danger', 'Existe(m) documento(s) relacionado(s), você tem que excluí-lo(s) primeiro');
        } else {
            $restorative_justice->delete();
            session()->flash('success', 'Excluído com sucesso.');
        }
    }
    // create document
    public function createDocument()
    {
        $data = $this->validate([
            'restorative_justice_id' => 'required',
            'title' => 'required|max:255',
            'path' => 'required|mimetypes:application/pdf',
            'user_create' => 'required|max:10',
            'prison_unit_id' => 'required|max:10',
        ]);

        /* cria o nome do documento */
        $document_name = $data['title'] . '-' . date('Y-m-d H:i:s');
        /* faz o upload e retorna o endereco do arquivo */
        $data['path'] = $this->path->storeAs('prisoner/' . $this->prisoner_id . '/documents' . '/legal_assistance', $document_name . '.' . $data['path']->getClientOriginalExtension());

        $data['title'] = mb_strtoupper($data['title'], 'utf-8');
        RestorativeJusticeDocument::create($data);
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
