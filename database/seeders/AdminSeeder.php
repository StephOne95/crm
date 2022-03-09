<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $user = User::factory()->create([
            'email'     => 'adminuser@example.com',
            'password'  => bcrypt('qwerty'),
        ]);

        $role = Role::admin()->first();
        $user->roles()->attach($role);
    }
}
