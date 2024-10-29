<?php

namespace App\Livewire\Main\LegalAssistance\VideoconferenceHearing;

use App\Livewire\Forms\VideoconferenceHearingForm;
use App\Models\Admin\LegalAssistance\CriminalCourt;
use App\Models\Admin\LegalAssistance\District;
use App\Models\Main\VideoconferenceHearing;
use App\Models\Main\VideoconferenceHearingDocument;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class VideoconferenceHearingLivewire extends Component
{
    use WithFileUploads;
    use WithPagination;
    public VideoconferenceHearingForm $videoconference_hearing_form;
    public $prisoner_id;
    public $districts = [];
    public $criminal_courts = [];
    public $statuses = ['MANTIDO', 'CANCELADO'];
    public $openModalCreate = false;
    public $openModalUpdate = false;
    public $openModalDelete = false;
    public $openModalRelatedDocumentCreate = false;
    public $openModalRelatedDocumentDelete = false;

    public function mount()
    {
        $this->districts = District::all();
        $this->criminal_courts = CriminalCourt::all();
    }
    // close modal
    public function closeModal()
    {
        $this->openModalCreate = false;
        $this->openModalUpdate = false;
        $this->openModalDelete = false;
        $this->openModalRelatedDocumentCreate = false;
        $this->openModalRelatedDocumentDelete = false;
        $this->videoconference_hearing_form->clearFields();
    }
    // modal create
    public function modalCreate()
    {
        $this->videoconference_hearing_form->prisoner_id = $this->prisoner_id;
        $this->openModalCreate = true;
    }
    // create
    public function create()
    {
        $this->videoconference_hearing_form->prison_unit_id = Auth::user()->prison_unit_id;
        $this->videoconference_hearing_form->user_create = Auth::user()->id;
        $this->videoconference_hearing_form->create();
        $this->closeModal();
    }
    // modal update
    public function modalUpdate(VideoconferenceHearing $videoconference_hearing)
    {
        $this->videoconference_hearing_form->setPost($videoconference_hearing);
        $this->openModalUpdate = true;
    }
    // update
    public function update()
    {
        $dataValidated = $this->validate();
        $this->videoconference_hearing_form->update($dataValidated);
        $this->openModalUpdate = false;
        $this->videoconference_hearing_form->clearFields();
        session()->flash('success', 'Atualizado com sucesso.');
        $this->render();
    }
    // modal delete
    public function modalDelete($id)
    {
        $this->openModalDelete = $id;
    }
    // delete
    public function delete(VideoconferenceHearing $videoconference_hearing)
    {
        $this->videoconference_hearing_form->delete($videoconference_hearing);
        $this->openModalDelete = false;
        $this->videoconference_hearing_form->clearFields();
        $this->render();
    }
    // modal related document create
    public function modalRelatedDocumentCreate($pk_v_h_id)
    {
        $this->videoconference_hearing_form->pk_v_h_id = $pk_v_h_id;
        $this->videoconference_hearing_form->prisoner_id = $this->prisoner_id;
        $this->openModalRelatedDocumentCreate = true;
    }
    // related document create
    public function createRelatedDocumment()
    {
        $this->videoconference_hearing_form->prison_unit_id = Auth::user()->prison_unit_id;
        $this->videoconference_hearing_form->user_create = Auth::user()->id;
        $this->videoconference_hearing_form->createDocument();
        $this->closeModal();
    }
    // modal related document delete
    public function modalRelatedDocumentDelete($pk_v_h_id)
    {
        $this->openModalRelatedDocumentDelete = $pk_v_h_id;
    }
    // related document delete
    public function deleteRelatedDocumment(VideoconferenceHearingDocument $document)
    {
        $this->videoconference_hearing_form->deleteDocument($document);
        $this->openModalRelatedDocumentDelete = false;
        $this->videoconference_hearing_form->clearFields();
        session()->flash('success', 'Excluído com sucesso.');
    }
    public function render()
    {
        $videoconference_hearings = VideoconferenceHearing::where('prisoner_id', $this->prisoner_id)
        ->with('videoconference_hearing_documents')
        ->orderBy('date_of_service', 'desc')
        ->paginate(5);
        return view('livewire.main.legal-assistance.videoconference-hearing.videoconference-hearing-livewire',
        compact('videoconference_hearings')
        );
    }
}
