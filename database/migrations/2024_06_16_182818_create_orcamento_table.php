<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrcamentoTable extends Migration
{
    public function up()
    {
        Schema::create('orcamento', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->string('nome', 80);
            $table->string('endereco', 60);
            $table->string('bairro', 40);
            $table->string('cep', 30);
            $table->string('cidade', 30);
            $table->string('uf', 2);
            $table->string('cpf', 18);
            $table->string('rg', 15);
            $table->string('email', 60);
            $table->string('telefone1', 14);
            $table->enum('tipo1', ['residencial', 'comercial', 'whatsapp']);
            $table->string('telefone2', 14)->nullable();
            $table->enum('tipo2', ['residencial', 'comercial', 'whatsapp'])->nullable();
            $table->string('telefone3', 14)->nullable();
            $table->enum('tipo3', ['residencial', 'comercial', 'whatsapp'])->nullable();
            $table->double('valor');
            $table->integer('convenio_id')->nullable();
            $table->integer('parcelas')->nullable();
            for ($i = 1; $i <= 12; $i++) {
                $table->timestamp("data_parcela$i")->nullable();
                $table->double("valor_parcela$i")->nullable();
            }
            $table->double('desconto_percentual')->nullable();
            $table->text('observacao')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orcamento');
    }
}
