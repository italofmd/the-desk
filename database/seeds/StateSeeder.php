<?php

use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{    
    public function run()
    {
        DB::table('state')->insert([
            ['uf' => 'ac', 'name' => 'Acre'],
            ['uf' => 'al', 'name' => 'Alagoas'],
            ['uf' => 'ap', 'name' => 'Amapá'],
            ['uf' => 'am', 'name' => 'Amazonas'],
            ['uf' => 'ba', 'name' => 'Bahia'],
            ['uf' => 'ce', 'name' => 'Ceará'],
            ['uf' => 'df', 'name' => 'Distrito Federal'],
            ['uf' => 'es', 'name' => 'Espírito Santo'],
            ['uf' => 'go', 'name' => 'Goiás'],
            ['uf' => 'ma', 'name' => 'Maranhão'],
            ['uf' => 'mt', 'name' => 'Mato Grosso'],
            ['uf' => 'ms', 'name' => 'Mato Grosso do Sul'],
            ['uf' => 'mg', 'name' => 'Minas Gerais'],
            ['uf' => 'pa', 'name' => 'Pará'],
            ['uf' => 'pb', 'name' => 'Paraíba'],
            ['uf' => 'pr', 'name' => 'Paraná'],
            ['uf' => 'pe', 'name' => 'Pernambuco'],
            ['uf' => 'pi', 'name' => 'Piauí'],
            ['uf' => 'rj', 'name' => 'Rio de Janeiro'],
            ['uf' => 'rn', 'name' => 'Rio Grande do Norte'],
            ['uf' => 'rs', 'name' => 'Rio Grande do Sul'],
            ['uf' => 'ro', 'name' => 'Rondônia'],
            ['uf' => 'rr', 'name' => 'Roraima'],
            ['uf' => 'sc', 'name' => 'Santa Catarina'],
            ['uf' => 'sp', 'name' => 'São Paulo'],
            ['uf' => 'se', 'name' => 'Sergipe'],
            ['uf' => 'to', 'name' => 'Tocantins']           
        ]);
    }
}
