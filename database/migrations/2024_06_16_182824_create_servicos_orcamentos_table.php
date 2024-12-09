<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicosOrcamentosTable extends Migration
{
    public function up()
    {
        Schema::create('servicos_orcamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orcamento_id')->constrained('orcamento')->onDelete('cascade');
            $table->string('descricao', 255);
            $table->string('dentes', 255);
            $table->string('faces', 255);
            $table->integer('quantidade');
            $table->double('valor');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('servicos_orcamentos');
    }
}
