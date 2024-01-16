<?php

namespace App\Livewire\Admin\LegalAssistance\Lawyers;

use App\Models\Admin\LegalAssistance\Lawyer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rules\File;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout("layouts.app")]
#[Title("Advogado")]
class LawyersLivewire extends Component
{
    use WithPagination;
    use WithFileUploads;
    // CLASS ACESSORIES
    public int $user_create;
    public int $user_update;
    public $prison_unit_id;
    public $photo = '';
    public $lawyer = '';
    public $register = '';
    public $contact = '';
    public $remark = '';

    public function mount()
    {
        $this->prison_unit_id   = Auth::user()->prison_unit_id;
        $this->user_create      = Auth::user()->id;
        $this->user_update      = Auth::user()->id;
    }

    // SEARCH - PESQUISA
    #[Url]
    public $search;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    //ADD NEW - ADICIONAR NOVO 
    public $add_new;
    public function addNew()
    {
        $this->add_new = true;
    }
    public function cancel()
    {
        $this->add_new = false;
    }

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function closeModal()
    {
        $this->openModalLawyerUpdate = false;
        $this->openModalLawyerDelete = false;
    }

    // CONVERT UPPERCASE
    public function convertUppercase($dataValidated)
    {
        $dataValidated['lawyer'] = mb_strtoupper ($dataValidated['lawyer'],'utf-8');
        $dataValidated['register'] = mb_strtoupper ($dataValidated['register'],'utf-8');
        $dataValidated['contact'] = mb_strtoupper ($dataValidated['contact'],'utf-8');
        $dataValidated['remark'] = mb_strtoupper ($dataValidated['remark'],'utf-8');
        return $dataValidated;
    }

    //CREATE NEW - CRIAR NOVO
    public function lawyerCreate()
    {
        $dataValidated = $this->validate(
            [
                'photo'         =>['nullable', File::image()->types(['jpeg', 'jpg', 'png'])],
                'lawyer'        =>'required|max:100',
                'register'      =>'required|max:100|unique:lawyers,lawyer',
                'contact'       =>'nullable|max:100',
                'remark'        =>'nullable',
                'user_create'   =>'required|max:10',
                'prison_unit_id'=>'required|max:10',
            ]
        );
        if ($this->photo) {
            /* responsável por excluir o diretório e a foto */
            if (!empty($photo)) {
                Storage::disk('public')->delete($photo);
            }
            $photo_name = str_replace("/", "-", $dataValidated['lawyer']. '_' .$dataValidated['register']);
            $photo_name = str_replace("\"", "", $photo_name);
            $photo_name = str_replace("\'", "", $photo_name);

            /* cria o nome da photo com a extensão */
            $photo_name = $photo_name . '.' . $dataValidated['photo']->getClientOriginalExtension();
            /* faz o upload e retorna o endereco do arquivo */
            $dataValidated['photo'] = $dataValidated['photo']->storeAs('lawyer/'. $dataValidated['lawyer']. '_' .$dataValidated['register'], $photo_name);
        }
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);
        Lawyer::create($dataValidated);
        $this->reset('lawyer');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $openModalLawyerUpdate = false;
    public function modalLawyerUpdate(Lawyer $lawyer)
    {
        $this->lawyer               = $lawyer->lawyer;
        $this->register             = $lawyer->register;
        $this->contact              = $lawyer->contact;
        $this->remark               = $lawyer->remark;
        $this->openModalLawyerUpdate= $lawyer->id;
    }
    // UPDATE
    public function lawyerUpdate(Lawyer $lawyer)
    {
        $dataValidated = $this->validate(
            [
                'lawyer'     =>"required|max:100|unique:lawyers,lawyer,{$lawyer->id},id",
                'register'   =>'required|max:100|unique:lawyers,lawyer',
                'contact'    =>'nullable|max:100',
                'remark'     =>'nullable',
                'user_update'=>'required|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated['lawyer'] = mb_strtoupper ($dataValidated['lawyer'],'utf-8');

        $lawyer->update($dataValidated);//atualiza os dados no banco
        $this->reset('lawyer');
        $this->openModalLawyerUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $openModalLawyerDelete = false;
    public function modalLawyerDelete($lawyer)
    {
        $this->openModalLawyerDelete = $lawyer;
    }
    // LEVEL ACCESS DELETE
    public function lawyerDelete(Lawyer $lawyer)
    {
        /* responsável por excluir o arquivo */
        if (!empty($lawyer->photo)) {
            Storage::disk('public')->delete($lawyer->photo);
        }
        $lawyer->delete();
        $this->openModalLawyerDelete = false;
    }
    public function render()
    {
        return view('livewire.admin.legal-assistance.lawyers.lawyers-livewire', [
            'lawyers' => Lawyer::orderBy('lawyer', 'asc')->where('lawyer', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
