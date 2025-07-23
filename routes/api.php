<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\HotelController;
use App\Http\Controllers\API\PackageController;
use App\Http\Controllers\API\ReservationController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\UserProfileController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::get('hotels', [HotelController::class, 'index']);
Route::get('services', [HotelController::class, 'services']);
Route::get('reviews/hotel/{hotel}', [HotelController::class, 'hotelReviews']);
Route::get('reviews', [ReviewController::class, 'index']);
Route::get('packages', [PackageController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', [UserProfileController::class, 'show']);
    Route::put('profile', [UserProfileController::class, 'update']);
    Route::post('reservation-form', [ReservationController::class, 'store']);

    Route::post('reviews', [ReviewController::class, 'store']);
    Route::post('logout', [AuthController::class, 'logout']);
});