<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    use HasFactory;

    protected $table = 'contas';

    protected $primaryKey = 'conta_id';

    protected $fillable = [
        'descricao',
        'tipo',
        'situacao',
    ];

    // Validation rules for tipo and situacao fields
    public static function rules()
    {
        return [
            'descricao' => 'required|string|max:100',
            'tipo' => 'required|in:R,D',
            'situacao' => 'required|in:A,D',
        ];
    }
}
