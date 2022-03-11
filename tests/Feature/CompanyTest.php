<?php

namespace Tests\Feature;

use App\Http\Services\CompanyFactoryService;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    /**
     * @test
     */
    public function subscriber_can_not_create_company_and_employee(): void
    {
        $this->withExceptionHandling();
        /** @var User $user */
        $user = User::factory()->create();
        $role = Role::create(['name' => Role::ROLE_SUBSCRIBER]);
        $user->roles()->attach($role);
        $this->actingAs($user);

        $this->postJson('/api/company')->assertStatus(403);
        $this->postJson('/api/employee')->assertStatus(403);

    }

    /**
     * @test
     */
    public function subscriber_can_not_update_company_and_employee(): void
    {
        $this->withExceptionHandling();

        /** @var User $user */
        $user = User::factory()->create();
        $role = Role::create(['name' => Role::ROLE_SUBSCRIBER]);
        $user->roles()->attach($role);
        $this->actingAs($user);

        $company  = Company::factory()->create();
        $employee = Employee::factory()->create(['company_id' => $company->id]);

        $this->putJson('/api/company/' . $company->id)->assertStatus(403);
        $this->putJson('/api/employee/' . $employee->id)->assertStatus(403);
    }

    /**
     * @test
     */
    public function subscriber_can_not_delete_company_and_employee(): void
    {
        $this->withExceptionHandling();

        /** @var User $user */
        $user = User::factory()->create();
        $role = Role::create(['name' => Role::ROLE_SUBSCRIBER]);
        $user->roles()->attach($role);
        $this->actingAs($user);

        $company = Company::factory()->create();
        $employee = Employee::factory()->create(['company_id' => $company->id]);

        $this->delete('/api/company/' . $company->id)->assertStatus(403);
        $this->delete('/api/employee/' . $employee->id)->assertStatus(403);
    }

    /**
     * @test
     */
    public function admin_create_company(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $role = Role::create(['name' => Role::ROLE_ADMIN]);
        $user->roles()->attach($role);
        $this->actingAs($user);

        $company = (new CompanyFactoryService())->companyFactory('50', '50');
        $this->withExceptionHandling()->postJson('/api/company', $company)->assertStatus(422);

        $company = (new CompanyFactoryService())->companyFactory('200', '200');
        $this->withExceptionHandling()->post('/api/company', $company);
        $this->assertDatabaseHas('companies', [
           'name'       => $company['name'],
           'logo'       => $company['logo'],
           'address'    => $company['address'],
           'website'    => $company['website'],
        ]);
    }

    /**
     * @test
     */
    public function admin_create_and_update_employee(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $role = Role::create(['name' => Role::ROLE_ADMIN]);
        $user->roles()->attach($role);
        $this->actingAs($user);

        $company = Company::factory()->create();
        $employee = Employee::factory()->create(['company_id' => $company->id]);

        $this->withExceptionHandling()->post('/api/employee', $employee->toArray());
        $this->assertDatabaseHas('employees', [
            'first_name'    => $employee['first_name'],
            'last_name'     => $employee['last_name'],
            'email'         => $employee['email'],
            'phone'         => $employee['phone'],
        ]);

        $this->withExceptionHandling()->put('/api/employee', $employee->toArray());
        $this->assertDatabaseHas('employees', [
            'first_name'    => $employee['first_name'],
            'last_name'     => $employee['last_name'],
            'email'         => $employee['email'],
            'phone'         => $employee['phone'],
        ]);
    }

    /**
     * @test
     */
    public function admin_delete_company_and_employee(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $role = Role::create(['name' => Role::ROLE_ADMIN]);
        $user->roles()->attach($role);
        $this->actingAs($user);

        $company  = Company::factory()->create();
        $employee = Employee::factory()->create(['company_id' => $company->id]);

        $this->delete('/api/employee/' . $employee->id)->assertStatus(200);
        $this->delete('/api/company/' . $company->id)->assertStatus(200);
    }

    /**
     * @dataProvider provider
     * @test
     */
    public function admin_and_subscriber_show_company($role): void
    {
        $company = Company::factory()->create();

        /** @var User $user */
        $user = User::factory()->create();
        $role = Role::create(['name' => $role]);
        $user->roles()->attach($role);
        $this->actingAs($user);

        $expected = ['data' => [
            'name' => $company->name,
            'logo' => $company->logo,
        ]];

        if ($role->isAdmin()) {
            $expected['data']['website'] = $company->website;
            $expected['data']['address'] = $company->address;
        }

        $result = $this->getJson('/api/company/' . $company->id);
        $result->assertJson($expected);
    }

    public function provider(): array
    {
        return [
            [Role::ROLE_SUBSCRIBER],
            [Role::ROLE_ADMIN]
        ];
    }

}
