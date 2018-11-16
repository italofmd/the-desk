<?php

use Illuminate\Database\Seeder;

class TypeUserSeeder extends Seeder
{

    public function run()
    {
        DB::table('type_user')->insert([
            ['name' => 'Administrador'],
            ['name' => 'Comum']
        ]);
    }
}
