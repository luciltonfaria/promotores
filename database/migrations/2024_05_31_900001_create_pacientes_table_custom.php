<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTableCustom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id('codigo');
            $table->string('nome', 35)->nullable();
            $table->date('dt_nasc')->nullable();
            $table->date('dt_cad')->nullable();
            $table->string('profissao', 20)->nullable();
            $table->char('estado_civil', 1)->nullable();
            $table->string('cpf', 11)->nullable();
            $table->double('convenio')->nullable();
            $table->date('dt_per_ini')->nullable();
            $table->date('dt_per_fin')->nullable();
            $table->char('per_status', 1)->nullable();
            $table->string('indicacao', 30)->nullable();
            $table->string('end_resid', 50)->nullable();
            $table->string('bairro_resid', 20)->nullable();
            $table->string('cidade_resid', 20)->nullable();
            $table->char('estado_resid', 2)->nullable();
            $table->string('cep_resid', 10)->nullable();
            $table->string('telef_resid', 16)->nullable();
            $table->string('telef_recado_resid', 16)->nullable();
            $table->string('celular', 16)->nullable();
            $table->string('end_comerc', 30)->nullable();
            $table->string('bairro_comerc', 20)->nullable();
            $table->string('cidade_comerc', 20)->nullable();
            $table->char('estado_comerc', 2)->nullable();
            $table->string('cep_comerc', 10)->nullable();
            $table->string('telef_comerc', 16)->nullable();
            $table->char('sexo', 1)->nullable();
            $table->text('obsev')->nullable();
            $table->string('niver', 4)->nullable();
            $table->string('nro_reg', 13)->nullable();
            $table->string('nome_seg', 35)->nullable();
            $table->string('foto', 120)->nullable();
            $table->string('telef2_resid', 16)->nullable();
            $table->string('telef2_comer', 16)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('rg', 15)->nullable();
            $table->string('org_rg', 15)->nullable();
            $table->string('filiacao_mae', 40)->nullable();
            $table->string('telefone1_tipo', 30)->nullable();
            $table->string('telefone2_tipo', 30)->nullable();
            $table->string('telefone3_tipo', 30)->nullable();
            $table->string('telefone4_tipo', 20)->nullable();
            $table->longText('obs_trat')->nullable();

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
        Schema::dropIfExists('pacientes');
    }
}
