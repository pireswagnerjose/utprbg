<?php

namespace App\Livewire\Main\Prisoner;

use App\Models\Main\Prisoner;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout("layouts.app")]
#[Title("Pesquisar")]
class PrisonerLivewire extends Component
{
    public $name;
    public $nickname;
    public $cpf;
    public $rg;
    public $title;
    public $birth_certificate;
    public $rji;
    public function render()
    {
        return view('livewire.main.prisoner.prisoner-livewire', [
            'prisoners' => Prisoner::orderBy('name', 'asc')
                ->where('name', 'like', "%{$this->name}%")
                ->where('nickname', 'like', "%{$this->nickname}%")
                ->where('cpf', 'like', "%{$this->cpf}%")
                ->where('rg', 'like', "%{$this->rg}%")
                ->where('title', 'like', "%{$this->title}%")
                ->where('birth_certificate', 'like', "%{$this->birth_certificate}%")
                ->where('rji', 'like', "%{$this->rji}%")
                ->paginate(12)
        ]);
    }
}
