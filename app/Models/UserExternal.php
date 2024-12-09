<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserExternal extends Model
{
    // Define a conexão do segundo banco
    protected $connection = 'second_db';

    // Nome da tabela
    protected $table = 'users';

    // Defina a chave primária (se for diferente do padrão 'id')
    protected $primaryKey = 'user_id';

    // Permitir ou não timestamps automáticos
    public $timestamps = false;

    // Permitir inserção em massa (opcional)
    protected $fillable = [
        'debit_base',
        'debit_premio',
        'username',
        'email',
        'created',
        'first_name' ,
        'last_name' ,
        'email' ,
        'status',
        'motivo' ,
        'inativo' ,
        'created' ,
        'company' ,
        'company2' ,
        'company_validation' ,
        'bairro' ,
        'zip' ,
        'city',
        'address' ,
        'uf',
        'phone',
    ];
}
