<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
    protected $table = 'jogos'; // Nome da tabela
    protected $primaryKey = 'jogo_id'; // Chave primária

    // Definir a conexão do banco de dados
    protected $connection = 'second_db';
    // Relacionamentos

    public function gamer()
    {
        return $this->belongsTo(Gamer::class, 'usuario_id', 'user_id');
    }

    public function loteriaRel()
    {
        return $this->belongsTo(Loteria::class, 'loteria', 'loteria_id');
    }

    public function modalidade()
    {
        return $this->belongsTo(Modalidade::class, 'modalidade_id', 'modalidade_id');
    }

    // Query Scope para Filtro por Período
    public function scopeFromPeriod($query, $startDate, $endDate)
    {
        return $query->whereBetween('data', [$startDate, $endDate]);
    }
 
     // Query Scope para Filtro por Usuário
     public function scopeByUsername($query, $username)
     {
         return $query->whereHas('usuario', function ($q) use ($username) {
             $q->where('username', 'LIKE', "%{$username}%");
         });
     }
 
     // Query Scope para Filtro por Loteria
     public function scopeByLoteria($query, $loteriaId)
     {
         return $query->where('loteria', $loteriaId);
     }

    public function getDescricaoModalidadeAttribute()
    {
        return $this->modalidade ? $this->modalidade->descricao : null;
    }
}

