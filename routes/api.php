<?php

use App\Actions\GetArenasAction;
use App\Actions\UserLoginAction;
use App\Actions\UserSignupAction;
use App\Models\Arena;
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

Route::prefix('users')->group(function () {
    Route::post('signup', UserSignupAction::class);
    Route::post('login', UserLoginAction::class);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('arenas', GetArenasAction::class);
    Route::get('arenas/{arena}', fn(Arena $arena) => $arena->load('location'));
});
