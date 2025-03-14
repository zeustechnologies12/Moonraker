<?php

namespace App\Traits;

use App\Models\Role;
use Illuminate\Validation\ValidationException;

trait CustomValidations
{
    public function validateRole($role)
    {
        $role = Role::where('name', $role)->first();
        if (!$role) {
            throw ValidationException::withMessages([
                'role' => 'Role not found !'
            ]);
        }
    }
}
