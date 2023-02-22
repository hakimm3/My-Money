<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IncomeCategory;

class IncomeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $incomeCategories = [
            [
                'name' => 'Gaji',
                'slug' => 'gaji',
            ],
            [
                'name' => 'Bonus',
                'slug' => 'bonus',
            ],
            [
                'name' => 'Lainnya',
                'slug' => 'lainnya',
            ]
        ];

        foreach ($incomeCategories as $incomeCategory) {
            IncomeCategory::create($incomeCategory);
        }
    }
}
