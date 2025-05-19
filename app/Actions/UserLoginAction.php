<?php

namespace App\Actions;

use App\Models\Role;
use App\Models\User;
use App\Traits\CustomValidations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;

class UserLoginAction
{
    use AsAction, CustomValidations;

    public function handle(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|string'
        ]);
        $user = User::whereEmail($request->email)->first();
        $this->validateRole($request->role);

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'wrong credentials' => 'Your email or password is incorrect'
            ]);
        }
        if (! $user->roles->contains('name', $request->role)) {
            throw ValidationException::withMessages([
                'wrong role' => 'Your role is incorrect for the user'
            ]);
        }
        return [
            'token' => $user->createToken($request->header('user-agent'))->plainTextToken,
            'user' => $user,
        ];
    }
}
