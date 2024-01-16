<?php

namespace App\Livewire\User;

use App\Models\Admin\LevelAccess as AdminLevelAccess;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Usuário do Sistema")]
class User extends Component
{
    use WithPagination;

    // CLASS ACESSORIES
    public $prison_units;
    public $level_accesses;
    public $userCreate;
    public $userUpdate;
    public function mount()
    {
        $this->prison_units = \App\Models\Admin\PrisonUnit::all();
        $this->level_accesses = AdminLevelAccess::all();
        $this->userCreate = Auth::user()->id;
        $this->userUpdate = Auth::user()->id;
    }

    // BUTTON ADD NEW USER
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
    public function clearFields()
    {
        $this->reset('userFirstName', 'userLastName', 'userRegistry', 'userPhone', 'userEmail',
            'userPrisonUnitId', 'userLevelAccessId', 'user_update', 'userPassword');
        $this->confirmingUserUpdate = false;
    }
    
    // ITENS CREATE-UPDATE
    public $userFirstName;
    public $userLastName;
    public $userRegistry;
    public $userPhone;
    public $userEmail;
    public $userPrisonUnitId;
    public $userLevelAccessId;
    public $userPassword;

    // CREATE NEW - CRIAR NOVO
    public function create()
    {
        //$user = \App\Models\User::all();
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'first_name'        => $this->userFirstName,
                'last_name'         => $this->userLastName,
                'registry'          => $this->userRegistry,
                'phone'             => $this->userPhone,
                'email'             => $this->userEmail,
                'prison_unit_id'    => $this->userPrisonUnitId,
                'level_access_id'   => $this->userLevelAccessId,
                'user_cpdate'       => $this->userCreate,
                'password'          => $this->userPassword
            ],
            // Validation rules to apply...
            [
                'first_name'        => 'max:60|string',
                'last_name'         => 'max:60|string',
                'registry'          => 'max:60|string',
                'phone'             => "required|string|min:15|max:15|unique:users,phone",//unico (usa o id da table pra validadar)
                'email'             => "required|string|email|max:60|unique:users,email",//unico (usa o id da table pra validadar)
                'prison_unit_id'    => 'max:10',
                'level_access_id'   => 'max:10',
                'user_cpdate'       => 'max:10',
                'password'          => 'min:8'
            ],
            [
                'phone.unique'=> 'Já exite um item com esse nome',
                'email.unique'=> 'Já exite um item com esse nome',
            ]
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['first_name'] = mb_strtoupper ($dataValidated['first_name'],'utf-8');
        $dataValidated['last_name'] = mb_strtoupper ($dataValidated['last_name'],'utf-8');

        $dataValidated ['password'] = Hash::make($dataValidated['password']);
        \App\Models\User::create($dataValidated);
        $this->reset('userFirstName', 'userLastName', 'userRegistry', 'userPhone', 'userEmail',
            'userPrisonUnitId', 'userLevelAccessId', 'user_update', 'userPassword');
        session()->flash('success', 'Created.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $confirmingUserUpdate = false;
    public function confirmgUserUpdate(\App\Models\User $user)
    {         
        $this->userFirstName        = $user->first_name;
        $this->userLastName         = $user->last_name;
        $this->userRegistry         = $user->registry;
        $this->userPhone            = $user->phone;
        $this->userEmail            = $user->email;
        $this->userPrisonUnitId     = $user->prison_unit_id;
        $this->userLevelAccessId    = $user->level_access_id;

        $this->confirmingUserUpdate = $user->id;
    }

    // USER UPDATE
    public function updateUser(\App\Models\User $user)
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'first_name'        => $this->userFirstName,
                'last_name'         => $this->userLastName,
                'registry'          => $this->userRegistry,
                'phone'             => $this->userPhone,
                'email'             => $this->userEmail,
                'prison_unit_id'    => $this->userPrisonUnitId,
                'level_access_id'   => $this->userLevelAccessId,
                'user_update'       => $this->userUpdate
            ],
            // Validation rules to apply...
            [
                'first_name'        => 'max:60|string',
                'last_name'         => 'max:60|string',
                'registry'          => 'max:60|string',
                'phone'             => "required|string|min:15|max:15|unique:users,phone,{$user->id},id",//unico (usa o id da table pra validadar)
                'email'             => "required|string|email|max:60|unique:users,email,{$user->id},id",//unico (usa o id da table pra validadar)
                'prison_unit_id'    => 'max:10',
                'level_access_id'   => 'max:10',
                'user_update'       => 'max:10',
            ],
            [
                'phone.unique'=> 'Já exite um item com esse nome',
                'email.unique'=> 'Já exite um item com esse nome',
            ]
         )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['first_name'] = mb_strtoupper ($dataValidated['first_name'],'utf-8');
        $dataValidated['last_name'] = mb_strtoupper ($dataValidated['last_name'],'utf-8');
        
        $user->update($dataValidated);//atualiza os dados no banco
        $this->reset('userFirstName', 'userLastName', 'userRegistry', 'userPhone', 'userEmail',
            'userPrisonUnitId', 'userLevelAccessId', 'user_update', 'userPassword');
        $this->confirmingUserUpdate = false;
    }
    
    // MODAL DELETE
    public $confirmingUserDeletion = false;
    public function confirmUserDeletion($userID)
    {
        $this->confirmingUserDeletion = $userID;
    }
    // USER DELETE
    public function deleteUser(\App\Models\User $user)
    {
        $user->delete();
        $this->confirmingUserDeletion = false;
    }

    // SEARCH
    public $search;
    public function render()
    {
        return view('livewire.user.user', [
            'users' => \App\Models\User::latest()
                ->where('first_name', 'like', "%{$this->search}%")
                ->orWhere('last_name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
