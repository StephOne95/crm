<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = User::factory(9)->create();

        $users->each(function ($user, $key) {
            $role = Role::subscriber()->first();
            $user->roles()->attach($role);
        });
    }
}
