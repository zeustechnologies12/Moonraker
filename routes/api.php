<?php

use App\Actions\UserLoginAction;
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
Route::post('login', UserLoginAction::class);
