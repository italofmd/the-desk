<?php

use Illuminate\Database\Seeder;

class TicketCategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('ticket_category')->insert([
            ['name' => 'Hardware'],
            ['name' => 'Software'],
            ['name' => 'Rede']
        ]);
    }
}
