<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagensOrcamento extends Model
{
    use HasFactory;

    protected $table = 'imagens_orcamentos';

    protected $fillable = [
        'orcamento_id',
        'path_imagem'
    ];

    public function orcamento()
    {
        return $this->belongsTo(Orcamento::class);
    }
}