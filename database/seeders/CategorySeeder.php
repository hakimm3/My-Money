<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Makanan Pokok', 'Makanan Jajan', 'Pembelajaran', 'Fashion', 'Transportasi', 'Hiburan', 'Tabungan' , 'Kebutuhan Dasar' ,'Lainnya'];
        foreach ($data as $value) {
            \App\Models\Category::create([
                'name' => $value,
                'slug' => Str::slug($value),
            ]);
        }
    }
}
