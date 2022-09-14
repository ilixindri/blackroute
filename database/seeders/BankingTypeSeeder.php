<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BankingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [
            [
                'id' => 1,
                'name' => 'gerencianet',
            ],
        ];

        BankingType::insert($values);
    }
}
