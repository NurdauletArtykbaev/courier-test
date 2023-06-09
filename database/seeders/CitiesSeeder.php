<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Алматы', 'Шымкент', 'Астана', 'Кызылорда', 'Семей'];
        foreach ($data as $datum) {
            City::create([
                'name' => $datum,
                'is_active' => true
            ]);
        }
    }
}
