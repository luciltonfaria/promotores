<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $table = 'estados';
    protected $primaryKey = 'sigla';  // Assuming 'sigla' is the primary key
    public $incrementing = false;     // Because 'sigla' is not auto-incrementing
    protected $keyType = 'string';    // Because 'sigla' is a string
    public function profissionais()
    {
        return $this->hasMany(Profissional::class, 'estado_resid', 'sigla');
    }
}
