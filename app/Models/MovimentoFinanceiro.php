<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimentoFinanceiro extends Model
{
    use HasFactory;

    protected $table = 'movimento_financeiro';
    protected $primaryKey = 'movimento_id';

    protected $fillable = [
        'data',
        'tipo',
        'cliente_fornecedor',
        'data_vencimento',
        'data_pagamento',
        'valor_devido',
        'valor_pago',
        'situacao',
        'data_situacao',
        'conta_id',
        'forma_pagto',
    ];

    protected $casts = [
        'data' => 'date',
        'data_vencimento' => 'date',
        'data_pagamento' => 'date',
        'data_situacao' => 'date',
        'valor_devido' => 'double',
        'valor_pago' => 'double',
    ];

    /**
     * Relacionamento com a tabela de Contas
     */
    public function conta()
    {
        return $this->belongsTo(Conta::class, 'conta_id');
    }

    /**
     * Relacionamento com a tabela de Pacientes (cliente/fornecedor)
     */
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'cliente_fornecedor', 'codigo');
    }

    /**
     * Relacionamento com o próprio movimento financeiro para referência de forma de pagamento
     */

    public function formaPagamento()
    {
        return $this->belongsTo(FormaPagto::class, 'forma_pagto', 'id');
    }

    /**
     * Regras de validação para o modelo MovimentoFinanceiro
     */
    public static function rules()
    {
        return [
            'data' => 'required|date',
            'tipo' => 'required|in:R,D',
            'cliente_fornecedor' => 'required|integer|exists:pacientes,codigo',
            'data_vencimento' => 'nullable|date',
            'data_pagamento' => 'nullable|date',
            'valor_devido' => 'nullable|numeric',
            'valor_pago' => 'nullable|numeric',
            'situacao' => 'required|string|max:100',
            'data_situacao' => 'nullable|date',
            'conta_id' => 'nullable|exists:contas,conta_id',
            'forma_pagto' => 'nullable|exists:forma_pagto,id',
        ];
    }
}
