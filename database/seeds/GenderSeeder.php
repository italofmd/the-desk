<?php

use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{    
    public function run()
    {
        DB::table('gender')->insert([
            ['name' => 'Feminino'],
            ['name' => 'Masculino'],
            ['name' => 'Prefiro não dizer']
        ]);
    }
}
