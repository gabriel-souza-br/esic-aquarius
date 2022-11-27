<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespostaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resposta', function (Blueprint $table) {
            $table->bigIncrements('id');
            /* Chaves Estrangeiras */
            $table->bigInteger('solicitacao_instancia_id')->unsigned()->index();
            /* Demais atributos */
            $table->text('resposta');
            $table->boolean('negacao_informacao')->nullable();
            $table->text('negacao_justificativa')->nullable();
            $table->timestamp('data_cadastro');
            $table->timestamp('data_inativacao')->nullable();

            /* Chaves Estrangeiras */
            $table->foreign('solicitacao_instancia_id')->references('id')->on('solicitacao_instancia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resposta');
    }
}
