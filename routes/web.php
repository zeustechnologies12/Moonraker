<?php

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/index', function () {
    return response()->json([
        'user' => User::find(1)
    ]);
});
