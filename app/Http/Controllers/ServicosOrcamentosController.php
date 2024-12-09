<?php

namespace App\Http\Controllers;

use App\Models\ServicosOrcamentos;
use Illuminate\Http\Request;

class ServicosOrcamentosController extends Controller
{
    public function store(Request $request, $orcamentoId)
    {
        $orcamento = \App\Models\Orcamento::find($orcamentoId);
        $procedimento = \App\Models\Procedimento::find($request->input('procedimento_id'));

        $servico = new ServicosOrcamentos([
            'descricao' => $procedimento->descricao,
            'dentes' => $request->input('dentes'),
            'faces' => $request->input('faces'),
            'quantidade' => $request->input('quantidade'),
            'valor' => $request->input('valor'),
        ]);

        $orcamento->servicosOrcamentos()->save($servico);

        return redirect()->route('orcamentos.show', $orcamentoId);
    }

    public function update(Request $request, $id)
    {
        $servico = ServicosOrcamentos::find($id);
        $servico->update($request->all());

        return redirect()->route('orcamentos.show', $servico->orcamento_id);
    }

    public function destroy($id)
    {
        $servico = ServicosOrcamentos::find($id);
        $servico->delete();

        return redirect()->route('orcamentos.show', $servico->orcamento_id);
    }
}
