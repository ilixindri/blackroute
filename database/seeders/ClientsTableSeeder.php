<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    public function run()
    {
        $clients = [
            [
                'name' => "Alexandro G Dos Santos",
                'email' => "alexandrogonsan@outlook.com",
                'rg' => "1456407953",
                'cpf' => "05289770593",
                'phone' => "+5595981042843",
                'whatsapp' => "+5595981042843",
                'birth_date' => "1993-07-18",
                'sexo' => "Masculino",
                'banking_id' => 1,
            ],
        ];

        Client::insert($clients);
    }
}
