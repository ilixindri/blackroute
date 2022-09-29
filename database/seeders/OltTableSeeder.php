<?php

namespace Database\Seeders;

use App\Models\Olt;
use Illuminate\Database\Seeder;

class OltTableSeeder extends Seeder
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
                'name' => 'Olt 1',
                'ports' => 4,
                'ip' => '10.0.0.1',
                'ssh_port' => 22,
                'ssh_user' => 'admin',
                'ssh_pass' => 'admin',
            ],
        ];

        Olt::insert($lines);
    }
}
