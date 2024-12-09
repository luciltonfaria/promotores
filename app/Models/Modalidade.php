<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modalidade extends Model
{
    protected $table = 'modalidades'; // Nome da tabela
    protected $primaryKey = 'modalidade_id'; // Chave primária
    // Definir a conexão do banco de dados
    protected $connection = 'second_db';
}
