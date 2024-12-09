<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicosOrcamentos extends Model
{
    use HasFactory;

    protected $table = 'servicos_orcamentos';

    protected $fillable = [
        'orcamento_id',
        'descricao',
        'dentes',
        'faces',
        'quantidade',
        'valor'
    ];

    public function orcamento()
    {
        return $this->belongsTo(Orcamento::class);
    }

    public function procedimento()
    {
        return $this->belongsTo(Procedimento::class);
    }
}
