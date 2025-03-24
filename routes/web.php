<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\TeamController; 
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\CrmController;
use App\Http\Controllers\Auth\adminlogincontroller;
use App\Http\Controllers\Admin\HotelsController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\AgentCallsController;
use App\Http\Controllers\Admin\HotelCallsController;
use App\Http\Controllers\Admin\TaxiBookingController;
use App\Http\Controllers\Admin\CustomerCallsController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\PushNotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now creatadd_team_viewe something great!
|
*/

// Route::get('/clear-cache', function () {
//     $exitCode = Artisan::call('cache:clear');
//     // $exitCode = Artisan::call('route:clear');
//     // $exitCode = Artisan::call('config:clear');
//     // $exitCode = Artisan::call('view:clear');
//     // return what you want
// });
//=========================================== FRONTEND =====================================================

Route::group(['prefix' => '/'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('login', [HomeController::class, 'login'])->name('login');
    Route::get('options', [HomeController::class, 'options'])->name('options');
    Route::get('hotel_list', [HomeController::class, 'hotel_list'])->name('hotel_list');
    Route::get('confirmation/{id}', [HomeController::class, 'confirmation'])->name('confirmation');
    Route::get('safari-confirmation/{id}', [HomeController::class, 'safariconfirmation'])->name('safari_confirmation');
    Route::get('hotel-confirmation/{id}', [HomeController::class, 'hotelconfirmation'])->name('hotel_confirmation');
    Route::get('guide-confirmation/{id}', [HomeController::class, 'guideconfirmation'])->name('guide_confirmation');
    Route::get('taxi-confirmation/{id}', [HomeController::class, 'taxiconfirmation'])->name('taxi_confirmation');
    
    Route::post('/save-tourist-details', [HomeController::class, 'saveTouristDetails'])->name('saveTouristDetails');

    Route::post('/upgrade-request', [HomeController::class, 'upgrade_request'])->name('upgrade_request');

    Route::get('/get-airports/{city_id}', [HomeController::class, 'getAirports']);
    Route::get('/get-vehicles-by-airport', [HomeController::class, 'getVehiclesByAirport']);
    Route::get('/get-vehicle/{cityId}', [HomeController::class, 'getVehiclesByCity']);
 

    Route::get('user_profile', [HomeController::class, 'user_profile'])->name('user_profile');

    // Route::post('/save-tourist-details/{id}', [HomeController::class, 'saveTouristDetails'])->name('saveTouristDetails');


    Route::get('taxi_booking', [HomeController::class, 'taxi_booking'])->name('taxi_booking');
    Route::get('list/{city_id}', [HomeController::class, 'list'])->name('list');
    Route::POST('add_package_booking/{id}', [HomeController::class, 'add_package_booking'])->name('add_package_booking');
    Route::post('book-airport-railway', [HomeController::class, 'book_airport_railway'])->name('book_airport_railway');
    Route::post('book-local-tour', [HomeController::class, 'book_local_tour'])->name('book_local_tour');
    Route::post('book-outstation', [HomeController::class, 'outstation'])->name('outstationbooked');
    Route::post('book-guide', [HomeController::class, 'bookguide'])->name('bookguide');
    Route::get('state_detail/{state_id}', [HomeController::class, 'state_detail'])->name('state_detail');


    Route::POST('add_confirmation/{id}', [HomeController::class, 'add_confirmation'])->name('add_confirmation');
    Route::POST('add-confirm-guide-booking/{id}', [HomeController::class, 'add_confirm_guide_booking'])->name('add_confirm_guide_booking');

    Route::get('all_images/{id}', [HomeController::class, 'all_images'])->name('all_images');
    Route::get('detail/{id}', [HomeController::class, 'detail'])->name('detail');

    Route::get('hotelsbooking', [HomeController::class, 'hotelsbooking'])->name('hotelsbooking');

    Route::get('/filter-hotels', [HomeController::class, 'filterHotels'])->name('filterHotels');
    Route::get('/filter-safari', [HomeController::class, 'filtersafari'])->name('filtersafari');





    Route::get('hotel_details/{id}', [HomeController::class, 'hotel_details'])->name('hotel_details');
    Route::POST('add_hotel_booking/{id}', [HomeController::class, 'add_hotel_booking'])->name('add_hotel_booking');

    Route::POST('add-hotel-confirm-booking/{id}', [HomeController::class, 'add_hotel_confirm_booking'])->name('add_hotel_confirm_booking');

    Route::POST('add-taxi-confirm-booking/{id}', [HomeController::class, 'add_taxi_confirm_booking'])->name('add_taxi_confirm_booking');

    Route::get('wildlife', [HomeController::class, 'wildlife'])->name('wildlife');
    Route::get('wildlife_detail/{id}', [HomeController::class, 'wildlife_detail'])->name('wildlife_detail');
    Route::POST('add_wildlife_booking/{id}', [HomeController::class, 'add_wildlife_booking'])->name('add_wildlife_booking');
    Route::POST('add_confirm_wildlife_booking/{id}', [HomeController::class, 'add_confirm_wildlife_booking'])->name('add_confirm_wildlife_booking');

    Route::post('wallet/store', [HomeController::class, 'add_wallet'])->name('wallet.store');

    Route::get('guide', [HomeController::class, 'guide'])->name('guide');
    Route::get('guide-cities/{stateId}', [HomeController::class, 'guide_cities'])->name('guide_cities');
    Route::get('/get-languages/{cityId}', [HomeController::class, 'getLanguagesByCity']);
    Route::get('/get-tour-guide-details', [HomeController::class, 'getTourGuideDetails']);

});

Route::post('signup', [AuthController::class, 'signup'])->name('signup_agent');
Route::get('cities/{stateId}', [HomeController::class, 'getCitiesByState']);
Route::post('verify_auth_otp', [AuthController::class, 'verify_auth_otp'])->name('verify_auth_otp');
Route::post('agentlogin', [AuthController::class, 'agentlogin'])->name('agentlogin');
// routes/web.php
Route::post('/agent/login/email', [AuthController::class, 'agentLoginWithEmail'])->name('agentLoginWithEmail');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::get('/get-vehicles-by-airport', [HomeController::class, 'getVehiclesByAirport']);

Route::post('/agent/login/mobile', [AuthController::class, 'agentLoginWithMobile'])->name('agentLoginWithMobile');


Route::post('verifyOtp', [AuthController::class, 'verifyOtp'])->name('verifyOtp');

//======================================= ADMIN ===================================================



Route::group(['prifix' => 'admin'], function () {
    Route::group(['middleware'=>'admin.guest'],function(){

        Route::get('/admin_index', [adminlogincontroller::class, 'admin_login'])->name('admin_login');
        Route::post('/login_process', [adminlogincontroller::class, 'admin_login_process'])->name('admin_login_process');

    });
    
});