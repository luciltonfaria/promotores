<?php

namespace App\Http\Controllers;

use App\Models\Especialidade;
use Illuminate\Http\Request;

class EspecialidadeController extends Controller
{
    public function index()
    {
        $especialidades = Especialidade::all();
        return view('especialidades.index', compact('especialidades'));
    }

    public function create()
    {
        return view('especialidades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'especialidade' => 'required|string|max:60',
        ]);

        Especialidade::create($request->all());

        return redirect()->route('especialidades.index')->with('success', 'Especialidade criada com sucesso.');
    }

    public function show($cod_espec)
    {
        $especialidade = Especialidade::findOrFail($cod_espec);
        return view('especialidades.show', compact('especialidade'));
    }

    public function edit($cod_espec)
    {
        $especialidade = Especialidade::findOrFail($cod_espec);
        return view('especialidades.edit', compact('especialidade'));
    }

    public function update(Request $request, $cod_espec)
    {
        $request->validate([
            'especialidade' => 'required|string|max:20',
        ]);

        $especialidade = Especialidade::findOrFail($cod_espec);
        $especialidade->update($request->all());

        return redirect()->route('especialidades.index')->with('success', 'Especialidade atualizada com sucesso.');
    }

    public function destroy($cod_espec)
    {
        $especialidade = Especialidade::findOrFail($cod_espec);
        $especialidade->delete();

        return redirect()->route('especialidades.index')->with('success', 'Especialidade deletada com sucesso.');
    }
}
