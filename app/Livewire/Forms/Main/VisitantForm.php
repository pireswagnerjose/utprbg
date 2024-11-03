<?php

namespace App\Livewire\Forms\Main;

use App\Models\Main\Visitant;
use App\Services\Main\Visitant\VisitantService;
use App\Traits\Main\Visitant\VisitantMessageTrait;
use App\Traits\Main\Visitant\VisitantPropertyTrait;
use App\Traits\Main\Visitant\VisitantRuleTrait;
use Illuminate\Support\Facades\Storage;
use Livewire\Form;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class VisitantForm extends Form
{
    public ?Visitant $visitant;
    use VisitantPropertyTrait;
    use VisitantRuleTrait;
    use VisitantMessageTrait;
    use WithFileUploads;
    use WithPagination;

    public function create()
    {
        $data = $this->validate();
        $data = (new VisitantService())->convertUppercase($data);
        $data['name'] = trim($data['name']);//Remove espaço em branco no começo do nome
        $visitant = Visitant::create($data);
        // Cadastra a foto do visitante
        if ($visitant) {
            $visitant_name = str_replace("/", "-", $this->name);//substitui a barra por traço no nome
            $photo = $visitant->id . ' - ' . $visitant_name . '.' . $data['photo']->getClientOriginalExtension();/* cria o nome da photo com a extensão */
            $data['photo'] = $data['photo']->storeAs('visitant/' . 'id - ' . $visitant->id, $photo);/* faz o upload e retorna o endereco do arquivo */
        } 
        $visitant->update($data);//Atualiza o endereço da foto no banco
        return $visitant;
    }

    public function setPost(Visitant $visitant)
    {
        $this->visitant             = $visitant;
        $this->name                 = $visitant->name;
        //$this->photo                = $visitant->photo;//não ativar
        $this->date_of_birth        = $visitant->date_of_birth;
        $this->cpf                  = $visitant->cpf;
        $this->phone                = $visitant->phone;
        $this->street               = $visitant->street;
        $this->number               = $visitant->number;
        $this->complement           = $visitant->complement;
        $this->barrio               = $visitant->barrio;
        $this->type_of_residence    = $visitant->type_of_residence;
        $this->status               = $visitant->status;
        $this->remark               = $visitant->remark;
        $this->civil_status_id      = $visitant->civil_status_id;
        $this->sex_id               = $visitant->sex_id;
        $this->municipality_id      = $visitant->municipality_id;
        $this->state_id             = $visitant->state_id;
    }

    public function update($data)
    {
        $data = (new VisitantService())->convertUppercase($data);
        //Remove espaço em branco no começo do nome
        $data['name'] = trim($data['name']);
        if (!empty($this->photo)) {
            /* responsável por excluir o documento */
            if (!empty($this->photo)) {
                Storage::disk('public')->delete($this->visitant->photo);
            }
            $visitant_name = trim($this->name);
            $visitant_name = str_replace("/", "-", $this->name);
            $photo = $this->visitant->id . ' - ' . $visitant_name . '.' . $data['photo']->getClientOriginalExtension();/* cria o nome da photo com a extensão */
            $data['photo'] = $data['photo']->storeAs('visitant/' . 'id - ' . $this->visitant->id, $photo);/* faz o upload e retorna o endereco do arquivo */
        }
        // quando não for atualizar a foto
        if(empty($this->photo))
        {
            $data['photo'] = $this->visitant->photo;
        }
        $this->visitant->update($data);
    }

    public function delete($visitant)
    {
        $visitant_delete = explode('/', $visitant->photo);//pega o endereço do diretório a ser excluído
        $diretory_delete = $visitant_delete[0]. '/' .$visitant_delete[1];//recupera o diretório a ser excluído
        
        /* responsável por excluir o documento */
        if (!empty($visitant->photo)) {
            Storage::disk('public')->deleteDirectory($diretory_delete);
        }
        $visitant->delete();
        session()->flash('success', 'Excluído com sucesso.');
    }

    public function search()
    {
        $visitants = Visitant::orderBy('name', 'asc')
            ->with('sex', 'civil_status', 'municipality', 'state')
            ->where('name', 'like', "%{$this->name}%")
            ->where('date_of_birth', 'like', "%{$this->date_of_birth}%")
            ->where('cpf', 'like', "%{$this->cpf}%")
            ->where('phone', 'like', "%{$this->phone}%")
            ->where('status', 'like', "%{$this->status}%")
            ->where('sex_id', 'like', "%{$this->sex_id}%")
            ->paginate(12);
        return $visitants;
    }
}
