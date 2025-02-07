<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\Controller;
use App\Models\Ability;
use App\Models\AbilityRole;
use App\Models\Feature;
use App\Models\Role;

class PermissionController extends Controller
{
    public function edit($id)
    {
        $features = Feature::orderBy('created_at', 'desc')->paginate(10);
        $role = Role::with('abilities')->find($id);
        $abilities = Ability::with('roles')->orderBy('nickname', 'asc')->get();
        return view("acl.permission.index", compact("role","abilities", 'features'));
    }

    public function create($ability_id, $role_id)
    {
        AbilityRole::create( [
            'ability_id' => $ability_id,
            'role_id' => $role_id,
        ]);
        return redirect()->route('permission.edit', $role_id)->with('success', 'Cadastrado com sucesso');
    }

    public function destroy($id)
    {
        $ability_role = AbilityRole::where('ability_id', $id)->first();
        AbilityRole::destroy($ability_role->id);
        return redirect()->route('permission.edit', $ability_role->role_id)->with('success', 'Excluido com sucesso');
    }
}
