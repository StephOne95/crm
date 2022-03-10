<?php

namespace App\Traits;

use App\Models\User;

trait PolicyTrait
{
    public function before(User $user): ?bool
    {
        if ($user->roles->first()->isAdmin()) {
            return true;
        }

        return null;
    }
}
