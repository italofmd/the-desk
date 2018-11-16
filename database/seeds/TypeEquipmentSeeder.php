<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeEquipmentSeeder extends Seeder
{

    public function run()
    {
        DB::table('type_equipment')->insert([
            ['name' => 'Outro'],
            ['name' => 'Desktop'],
            ['name' => 'Notebook'],
            ['name' => 'Servidor']
        ]);
    }
}