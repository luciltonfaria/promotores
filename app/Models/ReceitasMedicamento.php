<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceitasMedicamento extends Model
{
    use HasFactory;

    protected $fillable = ['receita_id', 'medicamento', 'quantidade', 'modo_usar'];

    public function receita()
    {
        return $this->belongsTo(Receita::class);
    }
}
