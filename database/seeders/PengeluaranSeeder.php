<?php

namespace Database\Seeders;

use App\Models\Spending;
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
        $categories = \App\Models\Category::get();

        Spending::where('user_id', \App\Models\User::where('email', 'tidursapu@gmail.com')->first()->id)->delete();

        for ($i = 0; $i < 1000; $i++) {
            \App\Models\Spending::create([
                'user_id' => \App\Models\User::where('email', 'tidursapu@gmail.com')->first()->id,
                'category_id' => $categories->random()->id,
                'amount' => $faker->numberBetween(10000, 100000),
                'date' => $faker->dateTimeBetween('-1 month', '+1 years'),
                'description' => $faker->sentence(5),
            ]);
        }
    }
}
