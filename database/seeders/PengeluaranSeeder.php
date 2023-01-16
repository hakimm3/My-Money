<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 100; $i++) {
            \App\Models\Pengeluaran::create([
                'user_id' => 1,
                'category_id' => $faker->numberBetween(1, 5),
                'amount' => $faker->numberBetween(10000, 100000),
                'date' => $faker->dateTimeBetween('-3 years', 'now'),
                'description' => $faker->sentence(5),
            ]);
        }
    }
}
