<?php

namespace Database\Seeders;

use App\Helpers\RoleHelper;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [RoleHelper::ADMIN];
        foreach ($data as $datum) {
            Role::create([
                'name' => $datum
            ]);
        }
    }
}
