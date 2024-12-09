<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anamnese extends Model
{
    // Define o nome da tabela associada a este model
    protected $table = 'anamnese';

    // Define a chave primária da tabela
    protected $primaryKey = 'codigo';

    // Permite que o Laravel trate esse campo como incrementável (opcional)
    public $incrementing = true;

    // Define o tipo da chave primária
    protected $keyType = 'int';

    // Desativa timestamps automáticos, já que não temos os campos created_at e updated_at
    public $timestamps = false;

    // Define os campos que podem ser preenchidos via mass-assignment (através de métodos como create() ou update())
    protected $fillable = [
        'paciente_id',
        'probl_saude',
        'probl_saude_quais',
        'toma_medicamentos',
        'toma_medic_quais',
        'gravida',
        'anestesia',
        'sentiu_mal',
        'alergico_medicamentos', // Corrigido
        'alergico_medicamentos_quais', // Corrigido
        'perdido_peso',
        'diabetis',
        'problemas_coracao',
        'problema_coracao__quais',
        'reumatica',
        'sangra_muito',
        'hepatite',
        'cirugia',
        'cirugia_quais',
        'gengiva_sangram',
        'mobilidade_dentes',
        'mobildade_quais',
        'escova_dentes',
        'fio_dental',
        'data',
        'sentiu_anestesia',
        'febre',
        'tonturas',
        'aspirina',
        'fuma',
        'bebe',
        'penicilina',
        'anemia',
        'infecciosa',
        'disturbio_neu',
        'problema_tto',
        'probl_tto_quais',
        'anticoagulante',
        'hemorragia',
        'complemento',
        'chb',
        'gengivas',
        'mucosa',
        'aboboda',
        'assoalho',
        'lingua',
        'labios',
        'outros',
        'qtd_dia_validade',
        'data_validade'
    ];
    
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id', 'codigo');
    }


    // Se precisar de relacionamentos ou escopos, pode-se adicionar aqui
}
