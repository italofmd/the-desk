<?php

use Illuminate\Database\Seeder;

class MaritalSeeder extends Seeder
{
    
    public function run()
    {
        DB::table('marital')->insert([
            ['name' => 'Solteiro'],
            ['name' => 'Casado'],
            ['name' => 'Divorciado'],
            ['name' => 'Viúvo'],
            ['name' => 'Separado']
        ]);
    }
}
