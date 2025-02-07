<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

use function Laravel\Prompts\search;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->search($request);
        $roles = $data->paginate(10);
        return view("acl.role.index", compact("roles"));
    }

    public function search($request)
    {
        $data = Role::orderBy('name', 'asc');
        if($request->search){
            $data = $data->whereLike('name', "%$request->search%");
        }
        return $data;
    }

    public function create()
    {
        $action = route('role.store');
        return view("acl.role.create", compact("action"));
    }

    public function store(Request $request)
    {
        $data = $request->validate(
        [ 'name' => 'required|string|max:100|min:3' ],
        ['name.required'=>'O campo Nome é obrigatório'] );
        
        $data['name'] = mb_strtoupper ($data['name'],'utf-8');
        Role::create( $data);
        return redirect()->route('role.index')->with('success', 'Cadastrado com sucesso');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $action = route('role.update', $id);
        return view('acl.role.create', compact('role', 'action'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $data = $request->validate(
            [ 'name' => 'required|string|max:100|min:3' ],
            ['name.required'=>'O campo Nome é obrigatório'] );

        $data['name'] = mb_strtoupper ($data['name'],'utf-8');
        $role->update($data);
        return redirect()->route('role.index')->with('success', 'Atualizada com sucesso');
    }

    public function destroy($id)
    {
        Role::destroy($id);
        return redirect()->route('role.index')->with('success', 'Excluido com sucesso');
    }
}
