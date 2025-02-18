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
| contains the "web" middleware group. Now create something great!
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
    Route::get('confirmation', [HomeController::class, 'confirmation'])->name('confirmation');
    Route::get('user_profile', [HomeController::class, 'user_profile'])->name('user_profile');
    Route::get('taxi_booking', [HomeController::class, 'taxi_booking'])->name('taxi_booking');
    Route::get('list', [HomeController::class, 'list'])->name('list');
    Route::get('detail', [HomeController::class, 'detail'])->name('detail');
    Route::get('hotelsbooking', [HomeController::class, 'hotelsbooking'])->name('hotelsbooking');
    Route::get('hotel_details', [HomeController::class, 'hotel_details'])->name('hotel_details');
    Route::get('wildlife', [HomeController::class, 'wildlife'])->name('wildlife');
    Route::get('wildlife_detail/{id}', [HomeController::class, 'wildlife_detail'])->name('wildlife_detail');

    Route::get('guide', [HomeController::class, 'guide'])->name('guide');
});

Route::post('signup', [AuthController::class, 'signup'])->name('signup_agent');
Route::get('cities/{stateId}', [HomeController::class, 'getCitiesByState']);
Route::post('verify_auth_otp', [AuthController::class, 'verify_auth_otp'])->name('verify_auth_otp');
Route::post('agentlogin', [AuthController::class, 'agentlogin'])->name('agentlogin');
// routes/web.php
Route::post('/agent/login/email', [AuthController::class, 'agentLoginWithEmail'])->name('agentLoginWithEmail');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');




Route::post('agentLoginWithMobile', [AuthController::class, 'agentLoginWithMobile'])->name('agentLoginWithMobile');

//======================================= ADMIN ===================================================



Route::group(['prifix' => 'admin'], function () {
    Route::group(['middleware'=>'admin.guest'],function(){

        Route::get('/admin_index', [adminlogincontroller::class, 'admin_login'])->name('admin_login');
        Route::post('/login_process', [adminlogincontroller::class, 'admin_login_process'])->name('admin_login_process');

    });
    
});