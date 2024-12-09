<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtestadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atestados', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->string('tipo');
            $table->string('nome_paciente');
            $table->string('codigo_paciente');
            $table->string('codigo_profissional');
            $table->date('data_comparecimento')->nullable();
            $table->time('hora_comparecimento')->nullable();
            $table->integer('dias_afastamento')->nullable();
            $table->string('cid10')->nullable();
            $table->text('procedimento_descricao')->nullable();
            $table->dateTime('data_impressao')->nullable();
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
        Schema::dropIfExists('atestados');
    }
}
