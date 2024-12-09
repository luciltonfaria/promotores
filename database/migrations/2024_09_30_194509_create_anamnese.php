<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnamnese extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anamnese', function (Blueprint $table) {
            $table->double('codigo_pacient');
            $table->double('probl_saude');
            $table->string('probl_saude_quais', 50)->nullable();
            $table->double('toma_medicamentos');
            $table->string('toma_medic_quais', 50)->nullable();
            $table->double('gravida');
            $table->double('anestesia');
            $table->double('sentiu_mal');
            $table->double('alergic_medic');
            $table->string('alergic_medic_quais', 50)->nullable();
            $table->double('perdid_peso');
            $table->double('diabetis');
            $table->double('probl_cora_');
            $table->string('probl_cora__quais', 50)->nullable();
            $table->double('reumatica');
            $table->double('sangra_muit');
            $table->double('hepatite');
            $table->double('cirugia');
            $table->string('cirugia_quais', 50)->nullable();
            $table->double('gengiva__sangr');
            $table->double('mobil_dentes');
            $table->string('mobil_quais', 50)->nullable();
            $table->string('escova_dentes', 15)->nullable();
            $table->double('fio_dental');
            $table->timestamp('data')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('sentiu_anestesia', 1)->nullable();
            $table->string('febre', 1)->nullable();
            $table->string('tonturas', 1)->nullable();
            $table->string('aspirina', 1)->nullable();
            $table->string('fuma', 1)->nullable();
            $table->string('bebe', 1)->nullable();
            $table->string('penicilina', 1)->nullable();
            $table->string('anemia', 1)->nullable();
            $table->string('infecciosa', 1)->nullable();
            $table->string('disturbio_neu', 1)->nullable();
            $table->string('problema_tto', 1)->nullable();
            $table->string('probl_tto_quais', 30)->nullable();
            $table->string('anticoagulante', 1)->nullable();
            $table->string('hemorragia', 1)->nullable();
            $table->string('complemento', 60)->nullable();
            $table->string('eplepsia', 1)->nullable();
            $table->integer('codigo')->notNull();
            $table->string('hipertensao', 1)->nullable();
            $table->string('pa', 10)->nullable();
            $table->string('chb', 20)->nullable();
            $table->string('oclusao', 20)->nullable();
            $table->string('gengivas', 20)->nullable();
            $table->string('mucosa', 20)->nullable();
            $table->string('aboboda', 20)->nullable();
            $table->string('assoalho', 20)->nullable();
            $table->string('lingua', 20)->nullable();
            $table->string('labios', 20)->nullable();
            $table->string('bochechas', 20)->nullable();
            $table->string('outros', 40)->nullable();
            $table->string('pergunta16', 45)->nullable();
            $table->double('resposta16')->nullable();
            $table->string('complem16', 45)->nullable();
            $table->string('pergunta17', 45)->nullable();
            $table->double('resposta17')->nullable();
            $table->string('complem17', 45)->nullable();
            $table->string('pergunta18', 45)->nullable();
            $table->double('resposta18')->nullable();
            $table->string('complem18', 45)->nullable();
            $table->string('pergunta19', 45)->nullable();
            $table->double('resposta19')->nullable();
            $table->string('complem19', 45)->nullable();
            $table->string('pergunta20', 45)->nullable();
            $table->double('resposta20')->nullable();
            $table->string('complem20', 45)->nullable();
            $table->string('pergunta21', 45)->nullable();
            $table->string('complen21', 45)->nullable();
            $table->string('pergunta22', 45)->nullable();
            $table->double('resposta22')->nullable();
            $table->string('complem22', 120)->nullable();
            $table->integer('qtd_dia_validade')->nullable();
            $table->timestamp('data_validade')->nullable();
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anamnese');
    }
}
