<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimentoFinanceirosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimento_financeiro', function (Blueprint $table) {
            $table->id('movimento_id');
            $table->date('data')->default(DB::raw('CURDATE()'));
            $table->char('tipo', 1);
            $table->integer('cliente_fornecedor');
            $table->date('data_lancamento')->default(DB::raw('CURDATE()'));
            $table->date('data_vencimento')->nullable();
            $table->date('data_pagamento')->nullable();
            $table->double('valor_devido')->nullable();
            $table->double('valor_pago')->nullable();
            $table->string('situacao', 100);
            $table->date('data_situacao')->nullable();
            $table->unsignedBigInteger('conta_id')->nullable();
            
            $table->foreign('conta_id')->references('conta_id')->on('contas')->onDelete('cascade');
            
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
        Schema::dropIfExists('movimento_financeiros');
    }
}
