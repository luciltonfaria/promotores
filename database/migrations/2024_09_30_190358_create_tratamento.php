<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTratamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tratamentos', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->integer('paciente_id');
            $table->integer('orcamento_id');
            $table->integer('contrato_id');
            $table->integer('especialidade_id')->nullable();
            $table->integer('convenio_id')->nullable();
            $table->date('data_inicio');
            $table->integer('status');
            $table->integer('indicacao');
            $table->date('pericia_inical');
            $table->integer('pericia_final');
            $table->string('odontograma_l1', 300);
            $table->string('odontograma_l2', 300);
            $table->string('odontograma_l3', 300);
            $table->string('odontograma_l4', 300);
            $table->text('observacao')->nullable();
            $table->date('data_retorno');
            $table->text('observacao_retorno')->nullable();
            $table->integer('observacao_financeito')->nullable();
            $table->timestamps();           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tratamento');
    }
}
