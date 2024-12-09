<?php

namespace App\Http\Controllers;

use App\Models\MovimentoFinanceiro;
use App\Models\Conta;
use App\Models\Paciente;
use App\Models\FormaPagto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MovimentoFinanceiroController extends Controller
{
    public function index(Request $request)
    {
        // Inicializa a consulta base com os relacionamentos
        $query = MovimentoFinanceiro::with(['paciente', 'conta', 'formaPagamento']);
    
        // Filtro por intervalo de Data de Pagamento
        if ($request->filled('data_pagamento_inicio') && $request->filled('data_pagamento_fim')) {
            $query->whereBetween('data_pagamento', [$request->input('data_pagamento_inicio'), $request->input('data_pagamento_fim')]);
        }
    
        // Filtro por intervalo de Data de Vencimento
        if ($request->filled('data_vencimento_inicio') && $request->filled('data_vencimento_fim')) {
            $query->whereBetween('data_vencimento', [$request->input('data_vencimento_inicio'), $request->input('data_vencimento_fim')]);
        }
    
        // Filtro por Nome do Paciente
        if ($request->filled('cliente_nome')) {
            $query->whereHas('paciente', function ($q) use ($request) {
                $q->where('nome', 'LIKE', '%' . $request->input('cliente_nome') . '%');
            });
        }
    
        // Filtro por Conta
        if ($request->filled('conta_id')) {
            $query->where('conta_id', $request->input('conta_id'));
        }
    
        // Filtro por Forma de Pagamento
        if ($request->filled('forma_pagto')) {
            $query->where('forma_pagto', $request->input('forma_pagto'));
        }
    
        // Obtém os movimentos financeiros filtrados
        $movimentos = $query->get();
    
        // Calcula o total de receitas (tipo "R")
        $totalReceitas = $movimentos->where('tipo', 'R')->sum('valor_pago');
    
        // Calcula o total de despesas (tipo "D")
        $totalDespesas = $movimentos->where('tipo', 'D')->sum('valor_pago');
    
        // Carrega todas as contas
        $contas = Conta::all();
        $formasPagto = FormaPagto::all(); // Carregar todas as formas de pagamento
    
        // Retorna a view com os movimentos, contas, formas de pagamento e os totais de receitas e despesas
        return view('movimentos.index', compact('movimentos', 'contas', 'formasPagto', 'totalReceitas', 'totalDespesas'));
    }
    

    
    

    // Show the form for creating a new resource
    public function create()
    {
        $pacientes = Paciente::all(); // Carrega todos os pacientes
        $contas = Conta::all(); // Fetch all contas for the dropdown
        $formasPagto = FormaPagto::all(); // Fetch all formas de pagamento
    
        return view('movimentos.create', compact('contas', 'pacientes', 'formasPagto'));
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        Log::info('Entrando no método Update', ['request' => $request->all()]);
    
        $data = $request->all();  // Copia todos os dados do request para o array $data
    
        // Conversão dos valores devidos e pagos para formato decimal
        if (isset($data['valor_devido'])) {
            $data['valor_devido'] = str_replace(['.', ','], ['', '.'], $data['valor_devido']); // Remove milhares e converte vírgula para ponto
        }
    
        if (isset($data['valor_pago'])) {
            $data['valor_pago'] = str_replace(['.', ','], ['', '.'], $data['valor_pago']); // Remove milhares e converte vírgula para ponto
        }
    
        // Validação manual do array $data modificado
        $validator = \Validator::make($data, MovimentoFinanceiro::rules());
    
        if ($validator->fails()) {
            // Registra os erros de validação no log
            Log::error('Erro de validação no update de Movimento Financeiro', [
                'errors' => $validator->errors()->all(),
                'request_data' => $data
            ]);
    
            // Se a validação falhar, retorna com os erros
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        Log::info('Dados validados', ['Data' => $data]);
    
        // Cria o primeiro movimento financeiro
        $movimento = MovimentoFinanceiro::create($data);
    
        // Lógica para repetição
        if ($request->filled('repetir_tipo') && $request->filled('repetir_valor')) {
            $repetirTipo = $request->repetir_tipo;
            $repetirValor = (int) $request->repetir_valor;
            $dataInicial = \Carbon\Carbon::parse($data['data_lancamento']);
    
            switch ($repetirTipo) {
                case 'dias':
                    for ($i = 1; $i < $repetirValor; $i++) {
                        MovimentoFinanceiro::create(array_merge($data, [
                            'data_lancamento' => $dataInicial->copy()->addDays($i * $repetirValor)->format('Y-m-d'),
                        ]));
                    }
                    break;
    
                case 'mensal':
                    for ($i = 1; $i < $repetirValor; $i++) {
                        MovimentoFinanceiro::create(array_merge($data, [
                            'data_lancamento' => $dataInicial->copy()->addMonths($i)->format('Y-m-d'),
                        ]));
                    }
                    break;
    
                case 'vezes':
                    // Repetir um número específico de vezes mensalmente
                    for ($i = 1; $i < $repetirValor; $i++) {
                        MovimentoFinanceiro::create(array_merge($data, [
                            'data_lancamento' => $dataInicial->copy()->addMonths($i)->format('Y-m-d'),
                        ]));
                    }
                    break;
            }
        }
    
        return redirect()->route('movimentos.index')->with('success', 'Movimento Financeiro created successfully.');
    }
    

    // Display the specified resource
    public function show(MovimentoFinanceiro $movimento)
    {
        return view('movimentos.show', compact('movimento'));
    }

    // Show the form for editing the specified resource
    public function edit(MovimentoFinanceiro $movimento)
    {
        $pacientes = Paciente::all(); // Carrega todos os pacientes
        $contas = Conta::all(); // Fetch all contas for the dropdown 
        return view('movimentos.edit', compact('movimento', 'pacientes', 'contas'));
    }

    // Update the specified resource in storage
    public function update(Request $request, MovimentoFinanceiro $movimento)
    {

         
        Log::info('Entrando no método Update', ['request' => $request->all()]);

        $data = $request->all();  // Copia todos os dados do request para o array $data

        if (isset($data['valor_devido'])) {
            $data['valor_devido'] = str_replace(['.', ','], ['', '.'], $data['valor_devido']); // Remove milhares e converte vírgula para ponto
        }
    
        if (isset($data['valor_pago'])) {
            $data['valor_pago'] = str_replace(['.', ','], ['', '.'], $data['valor_pago']); // Remove milhares e converte vírgula para ponto
        }
    
        // Validação manual do array $data modificado, usando o Validator ao invés do request->validate()
        $validator = \Validator::make($data, MovimentoFinanceiro::rules());
    
        if ($validator->fails()) {
            // Registra os erros de validação no log
            Log::error('Erro de validação no update de Movimento Financeiro', [
                'errors' => $validator->errors()->all(),
                'request_data' => $data
            ]);
    
            // Se a validação falhar, retorna com os erros
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Log::info('Alterado', ['Data' => $data]);
        

        $movimento->update($data);

        return redirect()->route('movimentos.index')->with('success', 'Movimento Financeiro updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy(MovimentoFinanceiro $movimento)
    {
        $movimento->delete();

        return redirect()->route('movimentos.index')->with('success', 'Movimento Financeiro deleted successfully.');
    }

    
}
