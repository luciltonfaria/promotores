<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfissionais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profissionais', function (Blueprint $table) {
            $table->id('codigo');
            $table->string('nome', 35)->nullable();
            $table->date('dt_nasc')->nullable();
            $table->date('dt_cad')->nullable();
            $table->string('cpf', 11)->nullable();
            $table->string('end_resid', 50)->nullable();
            $table->string('bairro_resid', 20)->nullable();
            $table->string('cidade_resid', 20)->nullable();
            $table->char('estado_resid', 2)->nullable();
            $table->string('cep_resid', 10)->nullable();
            $table->string('telef_resid', 16)->nullable();
            $table->string('celular', 16)->nullable();
            $table->char('sexo', 1)->nullable();
            $table->text('obsev')->nullable();
            $table->string('nro_conselho', 13)->nullable();
            $table->string('conselho', 35)->nullable();
            $table->string('foto', 120)->nullable();
            $table->string('telef2_resid', 16)->nullable();
            $table->string('telef2_comer', 16)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('rg', 15)->nullable();
            $table->string('org_rg', 15)->nullable();
            $table->string('filiacao_mae', 40)->nullable();
            $table->longText('observacoes')->nullable();

            $table->foreign('estado_resid')->references('sigla')->on('estados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profissionais');
    }
}
