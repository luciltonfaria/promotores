<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormaPagtoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forma_pagto', function (Blueprint $table) {
            $table->id(); // campo 'id' como chave primária
            $table->string('descricao', 20); // campo 'descricao' como varchar(20)
            $table->char('lanca_quitacao', 1); // campo 'lanca_quitacao' como varchar(1), para valores 'S' ou 'N'
            $table->timestamps(); // campos 'created_at' e 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forma_pagto');
    }
}
