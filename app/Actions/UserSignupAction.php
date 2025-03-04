<?php

namespace App\Actions;

use App\Models\User;
use App\Models\Role;
use App\RoleName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\Concerns\AsAction;

class UserSignupAction
{
    use AsAction;

    public function handle(Request $request)
    {
        // Validate Request
        $validation = Validator::make($request->all(), [
            'first_name' => 'required|string|unique:users,first_name',
            'last_name' => 'required|string|unique:users,last_name',
            'phone_number' => 'required|string|unique:users,phone_number',
            'username' => 'required|string|unique:users,username',
            'role' => ['required', Rule::enum(RoleName::class)],
            'password' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()], 400);
        }

        // Find Role ID
        $role = Role::where('name', $request->role)->first();
        if (!$role) {
            return response()->json(['error' => 'Role not found in database.'], 404);
        }

        // Create User
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $role->id,
        ]);

        return response()->json([
            'message' => 'User Created Successfully',
            'user' => $user
        ], 201);
    }
}
