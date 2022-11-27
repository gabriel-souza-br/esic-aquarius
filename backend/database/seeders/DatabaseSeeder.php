<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                'name' => 'Usuário Teste',
                'email' => 'teste@teste.com',
                'password' => Hash::make('12345678'),
            ]);
        }
        
    }
}
