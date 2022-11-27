<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTramiteNotaAnexoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tramite_nota_anexo', function (Blueprint $table) {
            $table->bigIncrements('id');
            /* Chaves Estrangeiras */
            $table->bigInteger('tramite_nota_id')->unsigned()->index();
            /* Demais atributos */
            $table->string('arquivo', 256);
            $table->string('arquivo_real', 256);
            $table->timestamp('data_cadastro');
            $table->timestamp('data_inativacao')->nullable();

            /* Chaves Estrangeiras */
            $table->foreign('tramite_nota_id')->references('id')->on('tramite_nota');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tramite_nota_anexo');
    }
}
