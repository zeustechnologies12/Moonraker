<?php

use App\Actions\CreateArenaAction;
use App\Actions\GetArenasAction;
use App\Actions\GetLocationsAction;
use App\Actions\UserEditAction;
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

// User apis
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('users/edit', UserEditAction::class);
    Route::get('arenas', GetArenasAction::class);
    Route::get('locations', GetLocationsAction::class);
    Route::get('arenas/{arena}', fn(Arena $arena) => $arena->load('location.city'));
});

//Manager APIs
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('arenas/create', CreateArenaAction::class);
    Route::get('user_arenas/', [GetArenasAction::class, 'userArenas']);
});
