<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    
    public function run()
    {
        DB::table('users')->insert([            
            'name' => 'Ítalo Ferreira',
            'email' => 'italofmd@hotmail.com',
            'password' => bcrypt('94029453'),
            'type_id' => '1'
        ]);
    }
}
