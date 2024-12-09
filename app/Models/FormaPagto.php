<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPagto extends Model
{
    use HasFactory;

    protected $table = 'forma_pagto';

    protected $fillable = [
        'descricao',
        'lanca_quitacao',
    ];
}
