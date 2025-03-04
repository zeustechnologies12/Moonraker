<?php

use App\Actions\UserSignupAction;
use App\Models\Role;
use App\Models\User;
use App\RoleName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

use function Laravel\Prompts\error;


Route::post('signup', UserSignupAction::class);

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
