<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->search($request);
        $features = $data->paginate(10);
        return view("acl.feature.index", compact("features"));
    }

    public function search($request)
    {
        $data = Feature::orderBy('title', 'asc');
        if($request->search){
            $data = $data->whereLike('title', "%$request->search%")
                ->orWhereLike('functionality', "%$request->search%");
        }
        return $data;
    }

    public function create()
    {
        $action = route('feature.store');
        return view("acl.feature.create", compact("action"));
    }

    public function store(Request $request)
    {
        $data = $request->validate(
        [
            'title' => 'required|string|max:100|min:3',
            'functionality' => 'required|string|max:100'
        ],
        [
            'title.required'=>'O campo é obrigatório',
            'title.max'=>'O campo deve ter no máximo 100 caracteres',
            'functionality.required'=>'O campo é obrigatório',
            'functionality.max'=>'O campo deve ter no máximo 100 caracteres'
        ] );
        $data['title'] = mb_strtoupper ($data['title'],'utf-8');
        Feature::create( $data);
        return redirect()->route('feature.index')->with('success', 'Cadastrado com sucesso');
    }

    public function edit($id)
    {
        $feature = Feature::findOrFail($id);
        $action = route('feature.update', $id);
        return view('acl.feature.create', compact('feature', 'action'));
    }

    public function update(Request $request, $id)
    {
        $role = Feature::findOrFail($id);
        $data = $request->validate(
        [
            'title' => 'required|string|max:100|min:3',
            'functionality' => 'required|string|max:100'
        ],
        [
            'title.required'=>'O campo é obrigatório',
            'title.max'=>'O campo deve ter no máximo 100 caracteres',
            'functionality.required'=>'O campo é obrigatório',
            'functionality.max'=>'O campo deve ter no máximo 100 caracteres'
        ] );

        $data['title'] = mb_strtoupper ($data['title'],'utf-8');
        $role->update($data);
        return redirect()->route('feature.index')->with('success', 'Atualizada com sucesso');
    }

    public function destroy($id)
    {
        Feature::destroy($id);
        return redirect()->route('feature.index')->with('success', 'Excluido com sucesso');
    }
}
