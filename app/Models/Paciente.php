<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    // Define o nome da tabela associada a este model
    protected $table = 'pacientes';

    // Define a chave primária da tabela
    protected $primaryKey = 'codigo';

    // Define se a chave primária é auto-incrementada
    public $incrementing = true;

    // Define o tipo da chave primária
    protected $keyType = 'double';

    // Define se os timestamps (created_at, updated_at) devem ser gerenciados pelo Eloquent
    public $timestamps = false;


    // Define os atributos que podem ser preenchidos em massa
    protected $fillable = [
        'nome',
        'dt_nasc',
        'dt_cad',
        'profissao',
        'estado_civil',
        'cpf',
        'convenio',
        'dt_per_ini',
        'dt_per_fin',
        'per_status',
        'indicacao',
        'end_resid',
        'bairro_resid',
        'cidade_resid',
        'estado_resid',
        'cep_resid',
        'telef_resid',
        'telef_recado_resid',
        'celular',
        'end_comerc',
        'bairro_comerc',
        'cidade_comerc',
        'estado_comerc',
        'cep_comerc',
        'telef_comerc',
        'sexo',
        'obsev',
        'niver',
        'nro_reg',
        'nome_seg',
        'foto',
        'telef2_resid',
        'telef2_comer',
        'email',
        'rg',
        'org_rg',
        'filiacao_mae',
        'telefone1_tipo',
        'telefone2_tipo',
        'telefone3_tipo',
        'telefone4_tipo',
        'obs_trat'
    ];

    // Define as relações, se houverem
    // Exemplo de relação com o modelo Estado
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_resid', 'sigla');
    }

    public function convenio()
    {
        return $this->belongsTo(Convenio::class, 'convenio', 'id');
    }

    public function anamnese()
    {
        return $this->hasOne(Anamnese::class, 'paciente_id', 'codigo'); // Assumindo que 'codigo' seja o campo que faz o relacionamento
    }


}
