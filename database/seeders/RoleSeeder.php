<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        foreach (Role::ROLES as $role) {
            Role::query()->create([
                'name' => $role,
            ]);
        }
    }
}
