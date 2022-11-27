<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstanciaResponsavelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instancia_responsavel', function (Blueprint $table) {
            $table->bigIncrements('id');
            /* Chaves Estrangeiras */
            $table->bigInteger('instancia_id')->unsigned()->index();
            $table->bigInteger('user_id')->unsigned()->index();

            $table->timestamp('data_cadastro');
            $table->timestamp('data_inativacao')->nullable();

            /* Chaves Estrangeiras */
            $table->foreign('instancia_id')->references('id')->on('instancia');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instancia_responsavel');
    }
}
