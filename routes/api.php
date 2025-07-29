<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\HotelController;
use App\Http\Controllers\API\PackageController;
use App\Http\Controllers\API\ReservationController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\UserProfileController;
use Illuminate\Support\Facades\Artisan;

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

    Route::get('/run-migrations', function (Request $request) {
        $key = $request->query('key');

        if ($key !== 'hhhlol') {
            abort(403);
        }

        Artisan::call('migrate', ['--force' => true]);
        return 'Migration done.';
    });

    Route::get('/run-seeder', function (Request $request) {
        $key = $request->query('key');

        if ($key !== 'hhhlol') {
            abort(403, 'Unauthorized');
        }

        Artisan::call('db:seed', [
            '--class' => 'AdminPermissionsSeeder',
            '--force' => true,
        ]);

        return 'Seeding done.';
    });