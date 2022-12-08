<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cpfcnpj', 14)->unique(); ## CPF ou CNPJ
            $table->string('nome', 70);
            $table->string('email', 80)->unique();
            $table->string('telefone', 11)->nullable();
            $table->string('celular', 11)->nullable();
            $table->string('cep', 8)->nullable();
            $table->string('logradouro', 80)->nullable();
            $table->string('bairro', 50)->nullable();
            $table->string('cidade', 50)->nullable();
            $table->string('numero', 10)->nullable();
            $table->string('complemento', 40)->nullable();
            $table->string('password', 256);
            $table->timestamp('data_cadastro');
            $table->string('codigo_ativacao', 40);
            $table->timestamp('data_ativacao')->nullable();
            $table->timestamp('data_inativacao')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
