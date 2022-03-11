<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\User;
use App\Traits\PolicyTrait;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy
{
    use HandlesAuthorization, PolicyTrait;

    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, Employee $employee): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user): bool
    {
        return false;
    }

    public function delete(User $user, Employee $employee): bool
    {
        return false;
    }
}
