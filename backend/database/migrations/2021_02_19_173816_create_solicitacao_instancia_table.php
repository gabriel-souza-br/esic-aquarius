<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitacaoInstanciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitacao_instancia', function (Blueprint $table) {
            $table->bigIncrements('id');
            /* Chaves Estrangeiras */
            $table->bigInteger('solicitacao_id')->unsigned()->index();
            $table->bigInteger('instancia_id')->unsigned()->index();
            /* Demais atributos */
            $table->timestamp('data_cadastro');

            /* Chaves Estrangeiras */
            $table->foreign('solicitacao_id')->references('id')->on('solicitacao');
            $table->foreign('instancia_id')->references('id')->on('instancia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitacao_instancia');
    }
}
