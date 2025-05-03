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
            'first_name' => 'required|string|unique:users,first_name',
            'last_name' => 'required|string|unique:users,last_name',
            'phone_number' => 'required|string|unique:users,phone_number',
            'username' => 'required|string|unique:users,username',
            'role' => ['required', Rule::enum(RoleEnum::class)],
            'password' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()], 400);
        }
        
        $this->validateRole($request->role);
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => Role::whereName($request->role)->first()->id,

        ]);

        return response()->json([
            'message' => 'User Created Successfully',
            'user' => $user->load('role'),
        ], 201);
    }
}
