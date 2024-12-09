<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loteria extends Model
{
    protected $table = 'loterias'; // Nome da tabela
    //protected $primaryKey = 'loteria_id'; // Chave primária
    // Definir a conexão do banco de dados
    protected $connection = 'second_db'; 
}
