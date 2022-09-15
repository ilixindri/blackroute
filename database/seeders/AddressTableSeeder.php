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
                'tipo' => 'Residencial',
                'cep' => '69312214',
                'logradouro' => 'Rua Dico Vieira',
                'numero' => 1140,
                'UF' => 'Boa Vista - RR',
                'complemento' => 'Casa',
                'bairro' => 'Caimbé',
                'coordinates' => '1,1',
            ],
        ];

        Address::insert($lines);
    }
}
