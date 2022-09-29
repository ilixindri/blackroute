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
                'id' => 1,
                'name' => "Alexandro G Dos Santos",
                'email' => "alexandrogonsan@outlook.com",
                'rg' => "1456407953",
                'cpf' => "05289770593",
                'phone' => "+5595981042843",
                'whatsapp' => "+5595981042843",
                'birth_date' => "1993-07-18",
                'user' => 'alexandrogonsan',
                'password' => '123456789',
                'sex' => "male",
                'banking_id' => 1,
                'plan_id' => 1,
                'expire_at' => 1,
                'until_days' => 45,
                'contract_id' => 1,
                'splitter' => 1,
                'cto_id' => 1,
                'mode' => 'ipoe',
                'ip' => '192.0.0.1',
                'mac' => '12:12:12:12:12:12',
            ],
        ];

        Client::insert($clients);
    }
}
