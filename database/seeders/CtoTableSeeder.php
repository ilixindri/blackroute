<?php

namespace Database\Seeders;

use App\Models\Cto;
use Illuminate\Database\Seeder;

class CtoTableSeeder extends Seeder
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
                'name' => 'Cto 1',
                'splitter' => 16,
            ],
        ];

        Cto::insert($lines);
    }
}
