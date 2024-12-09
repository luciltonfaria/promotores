<?php

// app/Models/Receita.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    use HasFactory;

    protected $fillable = ['data', 'nome_paciente', 'codigo_profissional', 'tipo_receita'];

    public function medicamentos()
    {
        return $this->hasMany(ReceitasMedicamento::class);
    }
    // Receita.php
    public function profissional()
    {
        return $this->belongsTo(Profissional::class, 'codigo_profissional', 'codigo');
    }

}
