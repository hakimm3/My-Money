<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IncomeCategory;

class IncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = IncomeCategory::get();
        $faker = \Faker\Factory::create('id_ID');

        \App\Models\Income::where('user_id', User::where('email', 'tidursapu@gmail.com')->first()->id)->delete();

        for($i = 0; $i < 1000; $i++) {
            \App\Models\Income::create([
                'user_id' => User::where('email', 'tidursapu@gmail.com')->first()->id,
                'category_id' => $categories->random()->id,
                'amount' => $faker->numberBetween(100000, 1000000),
                'description' => $faker->sentence,
                'date' => $faker->dateTimeBetween('-1 month', '+1 years')
            ]);
        }
    }
}
