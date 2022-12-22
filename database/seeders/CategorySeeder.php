<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Makanan Pokok', 'Makanan Jajan', 'Pembelajaran', 'Fashion', 'Transportasi', 'Hiburan', 'Lainnya'];
        foreach ($data as $value) {
            \App\Models\Category::create([
                'name' => $value
            ]);
        }
    }
}
