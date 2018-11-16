<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{  
    public function run()
    {
        DB::table('status')->insert([
            ['name' => 'Aberto'],
            ['name' => 'Atendendo'],
            ['name' => 'Resolvido'],
            ['name' => 'Cancelado']
        ]);
    }
}