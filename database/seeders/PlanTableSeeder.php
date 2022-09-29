<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanTableSeeder extends Seeder
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
                'name' => 'Plano 1G',
                'value' => 100,
                'until_days' => 5,
                'conditional_discount_type' => 'percentage',
                'conditional_discount_value' => 5,
            ],
        ];

        Plan::insert($lines);
    }
}
