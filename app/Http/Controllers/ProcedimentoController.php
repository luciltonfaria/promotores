<?php

namespace App\Http\Controllers;

use App\Models\Procedimento;
use Illuminate\Http\Request;

class ProcedimentoController extends Controller
{
    public function index()
    {
        $procedimentos = Procedimento::all();
        return view('procedimentos.index', compact('procedimentos'));
    }

    public function create()
    {
        return view('procedimentos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required',
        ]);

        Procedimento::create($request->all());

        return redirect()->route('procedimentos.index')
                         ->with('success', 'Procedimento criado com sucesso.');
    }

    public function show(Procedimento $procedimento)
    {
        return view('procedimentos.show', compact('procedimento'));
    }

    public function edit(Procedimento $procedimento)
    {
        return view('procedimentos.edit', compact('procedimento'));
    }

    public function update(Request $request, Procedimento $procedimento)
    {
        $request->validate([
            'descricao' => 'required',
        ]);

        $procedimento->update($request->all());

        return redirect()->route('procedimentos.index')
                         ->with('success', 'Procedimento atualizado com sucesso.');
    }

    public function destroy(Procedimento $procedimento)
    {
        $procedimento->delete();

        return redirect()->route('procedimentos.index')
                         ->with('success', 'Procedimento deletado com sucesso.');
    }
}
