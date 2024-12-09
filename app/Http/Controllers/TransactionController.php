<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Listar transações
    public function index(Request $request)
    {
        $transactions = Transaction::query();

        // Aplicar filtros opcionais
        if ($request->has('status')) {
            $transactions->where('status', $request->status);
        }

        if ($request->has('type')) {
            $transactions->where('type', $request->type);
        }

        if ($request->has('start_date') && $request->has('end_date')) {
            $transactions->whereBetween('time', [$request->start_date, $request->end_date]);
        }

        return view('transactions.index', [
            'transactions' => $transactions->paginate(10),
        ]);
    }

    // Mostrar detalhes de uma transação
    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);

        return view('transactions.show', compact('transaction'));
    }

    // Criar nova transação
    public function create()
    {
        return view('transactions.create');
    }

    // Salvar nova transação
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|integer',
            'amount' => 'required|numeric',
            'status' => 'required|string',
            // Adicione outras validações necessárias
        ]);

        Transaction::create($validated);

        return redirect()->route('transactions.index')->with('success', 'Transação criada com sucesso!');
    }

    // Editar transação
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);

        return view('transactions.edit', compact('transaction'));
    }

    // Atualizar transação
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'type' => 'required|integer',
            'amount' => 'required|numeric',
            'status' => 'required|string',
            // Adicione outras validações necessárias
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->update($validated);

        return redirect()->route('transactions.index')->with('success', 'Transação atualizada com sucesso!');
    }

    // Excluir transação
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transação excluída com sucesso!');
    }
}
