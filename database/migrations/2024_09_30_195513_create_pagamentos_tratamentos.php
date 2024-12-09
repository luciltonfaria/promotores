<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagamentosTratamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamentos_tratamentos', function (Blueprint $table) {
            $table->id();
            $table->integer("tratamento_id");
            $table->timestamp("data_parcela")->nullable();
            $table->double("valor_parcela")->nullable();
            $table->timestamp("data_pagto")->nullable();
            $table->double("valor_pagto")->nullable();
            $table->string("usuario")->nullable();
            $table->timestamp('data_lancamento')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagamentos_tratamentos');
    }
}
