<?php

use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{    
    public function run()
    {
        DB::table('profile')->insert([
            ['user_id' => 1]            
        ]);
    }
}
