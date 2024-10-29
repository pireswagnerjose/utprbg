<?php

namespace App\Livewire\Forms;

use App\Models\Main\VideoconferenceHearing;
use App\Models\Main\VideoconferenceHearingDocument;
use App\Traits\VideoconferenceHearingTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Form;
use Livewire\WithFileUploads;

class VideoconferenceHearingForm extends Form
{
    use WithFileUploads;
    public ?VideoconferenceHearing $videoconference_hearing_model;
    use VideoconferenceHearingTrait;//propriedades da tabela
    
    public $prisoner_id;
    public $user_create;
    public $user_update;
    public $prison_unit_id;
    public $date_of_service;
    public $time_of_service;
    public $status;
    public $remark;
    public $modality_care_id;
    public $district_id;
    public $criminal_court_id;
    public $modality_cares = [];
    public $districts = [];
    public $criminal_courts = [];
    public $videoconference_hearing;
    public $statuses = [];

    // document
    public $pk_v_h_id;
    public $title;
    public $path;

    // reset fields
    public function clearFields()
    {
        $this->reset(
            'criminal_court_id', 'district_id', 'date_of_service', 'time_of_service', 'status', 'remark', 'modality_care_id',
            'pk_v_h_id', 'title', 'path',
        );
    }
    // create 
    public function create()
    {
        $data = $this->validate();
        $data['remark']  = mb_strtoupper($data['remark'], 'utf-8');
        VideoconferenceHearing::create($data);
        $this->clearFields();
        session()->flash('success', 'Criado com sucesso.');
    }
    // set post
    public function setPost($videoconference_hearing)
    {
        $this->videoconference_hearing = $videoconference_hearing->videoconference_hearing;
        $this->date_of_service = $videoconference_hearing->date_of_service;
        $this->time_of_service = $videoconference_hearing->time_of_service;
        $this->status = $videoconference_hearing->status;
        $this->remark = $videoconference_hearing->remark;
        $this->modality_care_id = $videoconference_hearing->modality_care_id;
        $this->district_id = $videoconference_hearing->district_id;
        $this->criminal_court_id = $videoconference_hearing->criminal_court_id;
        $this->user_update = Auth::user()->id;
        $this->prison_unit_id = Auth::user()->prison_unit_id;
        $this->prisoner_id = $videoconference_hearing->prisoner_id;
        $this->videoconference_hearing_model = $videoconference_hearing;
    }
    // update
    public function update($dataValidated)
    {
        $dataValidated['remark']  = mb_strtoupper($dataValidated['remark'], 'utf-8');
        $this->videoconference_hearing_model->update($dataValidated);
        $this->clearFields();
    }
    // delete 
    public function delete($videoconference_hearing)
    {
        $teste = VideoconferenceHearingDocument::where('pk_v_h_id',$videoconference_hearing->id)->get()->first();
        if(!empty($teste))
        {
            return redirect()->back()->with('danger', 'Existe(m) documento(s) relacionado(s), você tem que excluí-lo(s) primeiro');  
        }else {
            $videoconference_hearing->delete();
            session()->flash('success', 'Excluído com sucesso.');
        }
    }
    // create document
    public function createDocument()
    {
        $data = $this->validate([
                'pk_v_h_id'         => 'required',
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
        VideoconferenceHearingDocument::create($data);
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
