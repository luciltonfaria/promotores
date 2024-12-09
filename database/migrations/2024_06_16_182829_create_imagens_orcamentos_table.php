<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagensOrcamentosTable extends Migration
{
    public function up()
    {
        Schema::create('imagens_orcamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orcamento_id')->constrained('orcamento')->onDelete('cascade');
            $table->string('path_imagem', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('imagens_orcamentos');
    }
}
