<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormaPagto;

class FormaPagtoController extends Controller
{
    // Função para listar todos os registros
    public function index()
    {
        $formasPagto = FormaPagto::all();
        return view('forma_pagto.index', compact('formasPagto'));
    }

    // Função para exibir o formulário de criação
    public function create()
    {
        return view('forma_pagto.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descricao' => 'required|string|max:20',
            'lanca_quitacao' => 'required|in:S,N',
        ]);
    
        FormaPagto::create($validatedData);
    
        return redirect()->route('forma_pagto.index')->with('success', 'Forma de Pagamento criada com sucesso.');
    }

    // Função para mostrar um registro específico
    public function show($id)
    {
        $formaPagto = FormaPagto::findOrFail($id);
        return view('forma_pagto.show', compact('formaPagto'));
    }

    // Função para exibir o formulário de edição
    public function edit($id)
    {
        $formaPagto = FormaPagto::findOrFail($id);
        return view('forma_pagto.edit', compact('formaPagto'));
    }

    // Função para atualizar um registro
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'descricao' => 'sometimes|required|string|max:20',
            'lanca_quitacao' => 'sometimes|required|in:S,N',
        ]);

        $formaPagto = FormaPagto::findOrFail($id);
        $formaPagto->update($validatedData);
        return redirect()->route('forma_pagto.index')->with('success', 'Forma de Pagamento atualizada com sucesso.');
    }

    // Função para deletar um registro
    public function destroy($id)
    {
        $formaPagto = FormaPagto::findOrFail($id);
        $formaPagto->delete();
        return redirect()->route('forma_pagto.index')->with('success', 'Forma de Pagamento deletada com sucesso.');
    }
}
