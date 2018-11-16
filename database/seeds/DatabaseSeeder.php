<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
 
    public function run()
    {
        $this->call(ManufacturerSeeder::class);
        $this->call(TypeEquipmentSeeder::class);
        $this->call(TicketCategorySeeder::class);
        $this->call(TypeUserSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(PrioritySeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(MaritalSeeder::class);
        $this->call(StateSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(ProfileSeeder::class);
    }
    
}

