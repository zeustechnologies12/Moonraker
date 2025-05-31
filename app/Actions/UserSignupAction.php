<?php

namespace App\Actions;

use App\Enums\RoleEnum;
use App\Models\User;
use App\Models\Role;
use App\Traits\CustomValidations;
use App\Traits\RoleValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\Concerns\AsAction;

class UserSignupAction
{
    use AsAction, CustomValidations;

    public function handle(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'first_name' => 'required|string|',
            'last_name' => 'required|string|',
            'username' => ['required', 'string', 'unique:users,username'],
            'phone_number' => 'required|string|',
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'role' => ['required', Rule::enum(RoleEnum::class)],
            'password' => 'required',
        ]);

        $this->validateRole($request->role);
        $role = Role::whereName($request->role)->first();

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (! $user->roles->contains('id', $role->id)) {
                $user->roles()->attach($role->id);
                return response()->json(['message' => "A new role  ($role->name) has been added for this user."]);
            } else {
                return response()->json(['errors' => "User with this Role ($role->name) already exists"]);
            }
        } else {
            if ($validation->fails()) {
                return response()->json(['errors' => $validation->errors()], 400);
            }
            $user = User::create([
                'first_name'   => $request->first_name,
                'last_name'    => $request->last_name,
                'username'     => $request->username,
                'phone_number' => $request->phone_number,
                'email'        => $request->email,
                'password'     => bcrypt($request->password),
            ]);
            $user->roles()->attach($role->id);
        }
        return response()->json([
            'message' => 'User Created Successfully',
        ], 201);
    }
}
