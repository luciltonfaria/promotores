<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    use HasFactory;

    protected $primaryKey = 'cod_espec';

    protected $fillable = [
        'especialidade',
    ];
}
