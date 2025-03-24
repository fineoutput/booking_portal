<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\SafariController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Route::middleware('auth:sanctum')->group(function () {

    Route::get('hotel', [HotelController::class, 'hotel']);
    Route::post('filter-hotel', [HotelController::class, 'filterHotels']);
    Route::get('packages', [HotelController::class, 'package']);
    Route::post('package-detailes', [HotelController::class, 'packagedetailes']);
    Route::post('package-booking', [HotelController::class, 'packagebooking']);

    Route::post('package-booking-se', [HotelController::class, 'confirm']);

    Route::post('/hotel-with-packages', [HotelController::class, 'getHotelWithPackages']);
    Route::post('/vehicle', [HotelController::class, 'vehicle']);
    Route::get('/wild-life-safari', [SafariController::class, 'wildsafari']);
    Route::get('/routes', [SafariController::class, 'routes']);
    Route::post('/tripguide', [SafariController::class, 'tripguide']);
    Route::post('/wild-life-safari-book', [SafariController::class, 'wildsafaribooked']);
    Route::post('/languages', [HotelController::class, 'getLanguages']);
    Route::get('/filter-state-city', [SafariController::class, 'filterStateCity']);
    Route::post('/hotel-state-city', [HotelController::class, 'statecityhotel']);
    Route::post('/hotel-booking', [HotelController::class, 'hotelbooking']);
    Route::post('/package-search', [HotelController::class, 'packagesearch']);
    Route::post('/add-wallet', [HotelController::class, 'add_wallet']);
    Route::get('/user-wallet', [HotelController::class, 'get_user_transactions']);
    Route::get('/admin-city', [HotelController::class, 'admin_city']);
    Route::post('/airport-vehicle', [HotelController::class, 'airport_vehicle']);
    Route::post('/local-vehicle', [HotelController::class, 'local_vehicle']);
    Route::get('/Appimage', [HotelController::class, 'Appimage']);

    Route::post('/taxi-booking', [HotelController::class, 'taxibooking']);
    Route::get('/constant', [HotelController::class, 'constant']);

    Route::get('/city', [HotelController::class, 'city']);
    Route::post('/book-guide', [HotelController::class, 'bookGuide']);
    Route::get('/airport', [HotelController::class, 'airport']);
    Route::post('/all-bookings', [HotelController::class, 'allbookings']);
    Route::get('/user-profile', [HotelController::class, 'profile']);
    Route::post('/popular-city', [HotelController::class, 'popularCity']);
    Route::get('/guide-city', [HotelController::class, 'guideCity']);





// });

Route::post('signup', [AuthController::class, 'signup']);
Route::post('verify_auth_otp', [AuthController::class, 'verify_auth_otp']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);