<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Kuliah',
            'Kuliah Semester 1',
            'Lebaran 2023',
        ];

        foreach ($data as $d) {
            \App\Models\Event::create([
                'name' => $d
            ]);
        }
    }
}
