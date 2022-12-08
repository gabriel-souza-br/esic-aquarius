<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_ENV', 'local') != 'PRODUCTION') {
            DB::table('users')->insert([
                'nome' => 'Usuário Teste',
                'cpfcnpj' => '17783660070',
                'email' => Str::random(10) . '@gmail.teste.com',
                'password' => Hash::make('12345678'),
                'codigo_ativacao' => Str::random(40),
                'data_cadastro' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
