<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 40; $i++) {
            Employee::factory()->create([
                'company_id'    => Company::inRandomOrder()->first()->id,
            ]);
        }
    }
}
