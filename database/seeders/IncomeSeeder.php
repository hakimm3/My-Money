<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for($i = 0; $i < 10; $i++) {
            $income = \App\Models\Income::create([
                'user_id' => 1,
                'category_id' => $faker->numberBetween(1, 3),
                'amount' => $faker->numberBetween(100000, 1000000),
                'description' => $faker->sentence,
                'date' => $faker->date,
            ]);
        }
    }
}
