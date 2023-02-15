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
            ],
            [
                'name' => 'Bonus',
            ],
            [
                'name' => 'Lainnya',
            ]
        ];

        foreach ($incomeCategories as $incomeCategory) {
            IncomeCategory::updateOrCreate(['name' => $incomeCategory['name']], $incomeCategory);
        }
    }
}
