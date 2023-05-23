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
        $user = \App\Models\User::get();
        $categories = \App\Models\Category::get();

        for ($i = 0; $i < 10000; $i++) {
            \App\Models\Pengeluaran::create([
                'user_id' => $user->random()->id,
                'category_id' => $categories->random()->id,
                'amount' => $faker->numberBetween(10000, 100000),
                'date' => $faker->dateTimeBetween('-3 years', 'now'),
                'description' => $faker->sentence(5),
            ]);
        }
    }
}
