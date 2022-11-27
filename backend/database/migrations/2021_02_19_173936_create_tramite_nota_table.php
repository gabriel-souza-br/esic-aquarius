<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTramiteNotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tramite_nota', function (Blueprint $table) {
            $table->bigIncrements('id');
            /* Chaves Estrangeiras */
            $table->bigInteger('tramite_id')->unsigned()->index();
            /* Demais atributos */
            $table->text('nota');
            $table->timestamp('data_cadastro');
            $table->timestamp('data_inativacao')->nullable();

            /* Chaves Estrangeiras */
            $table->foreign('tramite_id')->references('id')->on('tramite');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tramite_nota');
    }
}
