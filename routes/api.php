<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

use function Laravel\Prompts\error;


Route::post('signup', function (Request $request) {
    $validation = Validator::make($request->all(), [
        'name' => 'required|string|unique:users,name',
        'email' => 'required|email|unique:users,email',
        "password" => 'required',
    ]);
    if ($validation->fails()) {
        return response()->json([$validation->errors()]);
    }

    $user =  User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password
    ]);
    return response()->json([
        'message' => 'User Created Successfully',
        'user' => $user
    ]);
});

Route::post('login', function (Request $request) {

    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);
    $user = User::whereEmail($request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        $error =  ValidationException::withMessages([
            'email' => 'The provided credentials are incorrect'
        ]);
        throw $error;
    }

    return $user->createToken($request->header('user-agent'))->plainTextToken;
});
