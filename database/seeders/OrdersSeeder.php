<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::limit(10)->get();
        $cities = City::isActive()->get();
        foreach ($users as $user) {
            foreach (range(0,rand(1,5)) as $item) {
                $user->orders()->create([
                    'from_city_id' => $cities->random()->id,
                    'to_city_id' => $cities->random()->id,
                    'delivery_date' => now()->subDays(rand(0,15))
                ]);
            }
        };
    }
}
