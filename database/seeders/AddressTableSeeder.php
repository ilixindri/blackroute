<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lines = [
            [
                'id' => 1,
                'client_id' => 1,
                'type' => 'residential',
                'zip' => '69312214',
                'logradouro' => 'Rua Dico Vieira',
                'number' => 1140,
                'state' => 'Boa Vista - RR',
                'complemento' => 'Casa',
                'bairro' => 'Caimbé',
                'coordinates' => '1,1',
            ],
        ];

        Address::insert($lines);
    }
}
