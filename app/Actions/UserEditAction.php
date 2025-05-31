<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Lorisleiva\Actions\Concerns\AsAction;

class UserEditAction
{
    use AsAction;

    public function handle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'      => 'required|exists:users,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user =  User::findOrFail($request->user_id);
        $fields = ['first_name', 'last_name', 'username', 'phone_number', 'email'];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                $user->$field = $request->$field;
            }
        }
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return response()->json([
            'message' => "User Updated Sucessfully",
            'user' => $user
        ]);
    }
}
