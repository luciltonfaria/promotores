<?php
// database/migrations/xxxx_xx_xx_create_receitas_medicamentos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceitasMedicamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receitas_medicamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('receita_id');
            $table->string('medicamento');
            $table->string('quantidade');
            $table->text('modo_usar');
            $table->foreign('receita_id')->references('id')->on('receitas')->onDelete('cascade');
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
        Schema::dropIfExists('receitas_medicamentos');
    }
}
