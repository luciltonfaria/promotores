<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Orcamento extends Model
{
    use HasFactory;

    protected $table = 'orcamento';

    protected $fillable = [
        'data',
        'nome',
        'endereco',
        'bairro',
        'cep',
        'cidade',
        'uf',
        'cpf',
        'rg',
        'email',
        'telefone1',
        'tipo1',
        'telefone2',
        'tipo2',
        'telefone3',
        'tipo3',
        'valor_total',
        'data1pagto',
        'valor',
        'convenio_id',
        'parcelas',
        'desconto_percentual',
        'observacao',
        'indicado_por',
        'data_parcela1',
        'valor_parcela1',
        'data_parcela2',
        'valor_parcela2',
        'data_parcela3',
        'valor_parcela3',
        'data_parcela4',
        'valor_parcela4',
        'data_parcela5',
        'valor_parcela5',
        'data_parcela6',
        'valor_parcela6',
        'data_parcela7',
        'valor_parcela7',
        'data_parcela8',
        'valor_parcela8',
        'data_parcela9',
        'valor_parcela9',
        'data_parcela10',
        'valor_parcela10',
        'data_parcela11',
        'valor_parcela11',
        'data_parcela12',
        'valor_parcela12',        
        'valor_parcela12',  
        'forma_pagto'
    ];

    public function servicos()
    {
        return $this->hasMany(ServicosOrcamentos::class, 'orcamento_id');
    }

    public function imagens()
    {
        return $this->hasMany(ImagensOrcamento::class, 'orcamento_id');
    }

    
    public function upload(Request $request)
    {
        $request->validate([
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $request->file('imagem')->store('orcamentos', 'public');

        return redirect()->back()->with('imagem_path', $path);
    }
    // Relacionamento com a tabela `forma_pagto`
    public function formaPagto()
    {
        return $this->belongsTo(FormaPagto::class, 'forma_pagto', 'id');
    }

    public function convenio()
    {
        return $this->belongsTo(Convenio::class);
    }

}