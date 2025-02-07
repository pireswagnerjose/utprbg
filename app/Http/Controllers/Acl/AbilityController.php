<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\Controller;
use App\Models\Ability;
use App\Models\Feature;
use Illuminate\Http\Request;

class AbilityController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->search($request);
        $features = $data->paginate(5);
        $abilities = Ability::orderBy('name', 'asc')->get();
        return view("acl.ability.index", compact("abilities", "features"));
    }

    public function search($request)
    {
        $data = Feature::orderBy('created_at', 'desc');
        if($request->search){
            $data = $data->whereLike('title', "%$request->search%");
        }
        return $data;
    }

    public function create()
    {
        $features = Feature::all();
        $action = route('ability.store');
        return view("acl.ability.create", compact("action", 'features'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(
        [
            'name' => 'required|string|max:100|min:3',
            'nickname' => 'required|string|max:100',
            'feature_id' => 'required|max:10'
        ],
        [
            'name.required'=>'O campo é obrigatório',
            'name.max'=>'O campo deve ter no máximo 100 caracteres',
            'nickname.required'=>'O campo é obrigatório',
            'nickname.max'=>'O campo deve ter no máximo 100 caracteres'
        ] );
        $data['name'] = mb_strtoupper ($data['name'],'utf-8');
        Ability::create( $data);
        return redirect()->route('ability.index')->with('success', 'Cadastrado com sucesso');
    }

    public function edit($id)
    {
        $features = Feature::all();
        $ability = Ability::findOrFail($id);
        $action = route('ability.update', $id);
        return view('acl.ability.create', compact('ability', 'action', 'features'));
    }

    public function update(Request $request, $id)
    {
        $ability = Ability::findOrFail($id);
        $data = $request->validate(
        [
            'name' => 'required|string|max:100|min:3',
            'nickname' => 'required|string|max:100',
            'feature_id' => 'required|max:10'
        ],
        [
            'name.required'=>'O campo é obrigatório',
            'name.max'=>'O campo deve ter no máximo 100 caracteres',
            'nickname.required'=>'O campo é obrigatório',
            'nickname.max'=>'O campo deve ter no máximo 100 caracteres'
        ] );

        $data['name'] = mb_strtoupper ($data['name'],'utf-8');
        $ability->update($data);
        return redirect()->route('ability.index')->with('success', 'Atualizada com sucesso');
    }

    public function destroy($id)
    {
        Ability::destroy($id);
        return redirect()->route('ability.index')->with('success', 'Excluido com sucesso');
    }
}
