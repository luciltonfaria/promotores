<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atestado extends Model
{
    use HasFactory;

    protected $table = 'atestados';

    protected $fillable = [
        'data',
        'tipo',
        'nome_paciente',
        'codigo_paciente',
        'codigo_profissional',
        'data_comparecimento',
        'hora_comparecimento',
        'dias_afastamento',
        'cid10',
        'procedimento_descricao',
        'data_impressao'
    ];

    // Relação com o Profissional
    public function profissional()
    {
        return $this->belongsTo(Profissional::class, 'codigo_profissional', 'codigo');
    }
}
