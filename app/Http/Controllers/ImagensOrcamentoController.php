<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImagensOrcamento;

class ImagensOrcamentoController extends Controller
{
    public function store(Request $request, $orcamentoId)
    {
        $imagens = $request->file('imagens');

        foreach ($imagens as $imagem) {
            $path = $imagem->store('orcamentos_imagens', 'public'); // Salva a imagem na pasta 'storage/app/public/orcamentos_imagens'

            ImagensOrcamento::create([
                'orcamento_id' => $orcamentoId,
                'path_imagem' => $path
            ]);
        }

        return redirect()->back()->with('success', 'Imagens salvas com sucesso!');
    }
}