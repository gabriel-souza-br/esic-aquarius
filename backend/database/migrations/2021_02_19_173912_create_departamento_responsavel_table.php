<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartamentoResponsavelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamento_responsavel', function (Blueprint $table) {
            $table->bigIncrements('id');
            /* Chaves Estrangeiras */
            $table->bigInteger('departamento_id')->unsigned()->index();
            $table->bigInteger('user_id')->unsigned()->index();
            /* Demais atributos */
            $table->timestamp('data_cadastro');
            $table->timestamp('data_inativacao')->nullable();

            /* Chaves Estrangeiras */
            $table->foreign('departamento_id')->references('id')->on('departamento');
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
        Schema::dropIfExists('departamento_responsavel');
    }
}
