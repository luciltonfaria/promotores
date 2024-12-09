<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gamer extends Model
{
        protected $table = 'users'; // Nome da tabela
        protected $primaryKey = 'user_id'; // Chave primária
        // Definir a conexão do banco de dados
        protected $connection = 'second_db';
}
