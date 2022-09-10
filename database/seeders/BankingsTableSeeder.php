<?php

namespace Database\Seeders;

use App\Models\Banking;
use Illuminate\Database\Seeder;

class BankingsTableSeeder extends Seeder
{
    public function run()
    {
        $bankings = [
            [
                'id' => 1,
                'name' => 'Lux CRM',
                'client_id_production' => "Client_Id_20e76e030a3e1205b2809decf93bffc037f50433",
                'client_secret_production' => "Client_Secret_61d98106b240fb26e7e77f2c33139d1f72a06ca9",
                'client_id_homologation' => "Client_Id_5f7bab7a270542b3cc47f987b2a518273d20ddc9",
                'client_secret_homologation' => "Client_Secret_a9aba34e50a8f9f320072e2b8eb03d257eac169c",
                'fine' => 0,
                'interest' => 0,
                'sandbox' => 1,
                'notification_url' => 'domain.com',
            ],
        ];

        Banking::insert($bankings);
    }
}