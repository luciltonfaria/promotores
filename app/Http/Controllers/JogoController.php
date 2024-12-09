<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jogo;
use App\Models\Loteria;

class JogoController extends Controller
{
    public function index(Request $request)
    {
        // Filtros de entrada
        $startDate = $request->input('start_date');  // Start date
        $endDate = $request->input('end_date');      // End date
        $gamerName = $request->input('gamer_name');  // Gamer name (optional)
        $loteriaId = $request->input('loteria');     // Loteria filter (optional)

        $today = now()->toDateString(); // Data atual formatada como 'YYYY-MM-DD'

        $jogos = Jogo::with(['gamer', 'loteriaRel', 'modalidade'])
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->fromPeriod($startDate, $endDate); // Aplicando o filtro de período
            }, function ($query) use ($today) {
                return $query->fromPeriod($today, $today); // Aplicando o filtro para a data atual como padrão
            })
            ->when($gamerName, fn($query) => $query->byGamer($gamerName))
            ->when($loteriaId, fn($query) => $query->byLoteria($loteriaId))
            ->get();

        // Dados auxiliares para filtros
        $loterias = Loteria::orderBy('descricao')->get();
        

        return view('jogos.index', compact('jogos', 'loterias', 'startDate', 'endDate', 'gamerName', 'loteriaId'));

    }
    

    public function relatorio(Request $request)
    {
        $inicio = $request->input('inicio');
        $final = $request->input('final');
        $loteria = $request->input('loteria_id');
        $grupo = $request->input('loteria_gr');

        // Implementação da lógica do relatório

        return response()->json(['message' => 'Relatório gerado com sucesso']);
    }
}
