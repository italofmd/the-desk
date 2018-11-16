<?php

use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{   
    public function run()
    {
        DB::table('priority')->insert([
            ['name' => 'Normal'],
            ['name' => 'Baixa'],
            ['name' => 'Alta']            
        ]);
    }
}
