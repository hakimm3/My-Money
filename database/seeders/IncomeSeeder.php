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
        $user = User::get();
        $categories = IncomeCategory::get();
        $faker = \Faker\Factory::create('id_ID');
        for($i = 0; $i < 10; $i++) {
            $income = \App\Models\Income::create([
                'user_id' => $user->random()->id,
                'category_id' => $categories->random()->id,
                'amount' => $faker->numberBetween(100000, 1000000),
                'description' => $faker->sentence,
                'date' => $faker->date,
            ]);
        }
    }
}
