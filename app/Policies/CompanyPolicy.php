<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use App\Traits\PolicyTrait;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization, PolicyTrait;

    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, Company $company): bool
    {
        return $user->roles()->first()->isSubscriber();
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user): bool
    {
        return false;
    }

    public function delete(User $user, Company $company): bool
    {
        return false;
    }
}
