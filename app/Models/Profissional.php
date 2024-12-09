<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profissional extends Model
{
    use HasFactory;

    protected $table = 'profissionais';

    protected $primaryKey = 'codigo';

    protected $fillable = [
        'nome',
        'dt_nasc',
        'dt_cad',
        'cpf',
        'end_resid',
        'bairro_resid',
        'cidade_resid',
        'estado_resid',
        'cep_resid',
        'telef_resid',
        'celular',
        'sexo',
        'obsev',
        'nro_conselho',
        'conselho',
        'foto',
        'telef2_resid',
        'telef2_comer',
        'email',
        'rg',
        'org_rg',
        'filiacao_mae',
        'observacoes'
    ];

    // Define the relationship with the Estado model
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_resid', 'sigla');
    }
}
