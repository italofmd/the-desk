<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManufacturerSeeder extends Seeder
{

    public function run()
    {
        DB::table('manufacturer')->insert([
            ['name' => 'Outra'],
            ['name' => 'Acer'],
            ['name' => 'Dell'],
            ['name' => 'Lenovo'],
            ['name' => 'Samsung'],
            ['name' => 'HP']
        ]);
    }
    
}
