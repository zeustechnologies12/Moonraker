<?php

use App\Actions\BookingAction;
use App\Actions\CreateArenaAction;
use App\Actions\CreateBookingAction;
use App\Actions\GetArenasAction;
use App\Actions\GetBookingsAction;
use App\Actions\GetLocationsAction;
use App\Actions\UserEditAction;
use App\Actions\UserLoginAction;
use App\Actions\UserSignupAction;
use App\Models\Arena;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function () {
    Route::post('signup', UserSignupAction::class);
    Route::post('login', UserLoginAction::class);
});

// User apis
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('users/edit', UserEditAction::class);
    Route::get('arenas', GetArenasAction::class);
    Route::get('locations', GetLocationsAction::class);
    Route::get('arenas/{arena}', fn (Arena $arena) => $arena->load('location.city'));
    Route::post('fields/{field}/booking', CreateBookingAction::class);
});

// Manager APIs
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('arenas/create', CreateArenaAction::class);
    Route::get('user_arenas/', [GetArenasAction::class, 'userArenas']);
    Route::get('arena/{arena}/bookings', GetBookingsAction::class);
    Route::post('booking/{booking}/{action}', BookingAction::class);
    Route::get('user_bookings', [GetBookingsAction::class, 'userBookings']);

});
