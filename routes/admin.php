<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\TeamController; 
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\CrmController;
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
use App\Http\Controllers\Auth\adminlogincontroller;


Route::group(['prifix' => 'admin'], function () {

Route::group(['middleware'=>'admin.auth'],function(){
    Route::get('/index', [TeamController::class, 'admin_index'])->name('admin_index');
    Route::get('/logout', [adminlogincontroller::class, 'admin_logout'])->name('admin_logout');
    Route::get('/profile', [adminlogincontroller::class, 'admin_profile'])->name('admin_profile');
    Route::get('/view_change_password', [adminlogincontroller::class, 'admin_change_pass_view'])->name('view_change_password');
    Route::post('/admin_change_password', [adminlogincontroller::class, 'admin_change_password'])->name('admin_change_password');
   
           // Admin Team ------------------------
   
   Route::get('/view_team', [TeamController::class, 'view_team'])->name('view_team');
   Route::get('/add_team_view', [TeamController::class, 'add_team_view'])->name('add_team_view');
   Route::post('/add_team_process', [TeamController::class, 'add_team_process'])->name('add_team_process');
   Route::get('/UpdateTeamStatus/{status}/{id}', [TeamController::class, 'UpdateTeamStatus'])->name('UpdateTeamStatus');
   Route::get('/deleteTeam/{id}', [TeamController::class, 'deleteTeam'])->name('deleteTeam');
   
   
   
   // Admin CRM settings ------------------------
   Route::get('/add_settings', [CrmController::class, 'add_settings'])->name('add_settings');
   Route::get('/view_settings', [CrmController::class, 'view_settings'])->name('view_settings');
   Route::get('/update_settings/{id}', [CrmController::class, 'update_settings'])->name('update_settings');
   Route::post('/add_settings_process', [CrmController::class, 'add_settings_process'])->name('add_settings_process');
   Route::post('/update_settings_process/{id}', [CrmController::class, 'update_settings_process'])->name('update_settings_process');
   Route::get('/deletesetting/{id}', [CrmController::class, 'deletesetting'])->name('deletesetting');


   //  Hotels  ------------------------
   Route::get('/hotels', [HotelsController::class, 'index'])->name('hotels');
   Route::match(['get','post'],'/hotels/create', [HotelsController::class, 'create'])->name('add_hotels');
   Route::get('hotels/{hotel}/edit', [HotelsController::class, 'edit'])->name('hotels.edit');
    Route::put('hotels/{hotel}', [HotelsController::class, 'update'])->name('hotels.update');
    Route::delete('hotels/{hotel}', [HotelsController::class, 'destroy'])->name('hotels.destroy');
   
   // Package --------------------------
   Route::get('/package', [PackageController::class, 'index'])->name('package');
   Route::match(['get','post'],'/package/create', [PackageController::class, 'create'])->name('add_package');
   Route::delete('/packages/{id}', [PackageController::class, 'destroy'])->name('packages.destroy');
   Route::get('packages/{id}/edit', [PackageController::class, 'edit'])->name('packages.edit');
   Route::put('packages/{id}', [PackageController::class, 'update'])->name('update_hotels');



   Route::get('/AgentCalls', [AgentCallsController::class, 'index'])->name('AgentCalls');
   Route::match(['get','post'],'/AgentCalls/create', [AgentCallsController::class, 'create'])->name('add_AgentCalls');
   Route::get('AgentCalls/{id}/edit', [AgentCallsController::class, 'edit'])->name('AgentCalls.edit');
    Route::put('AgentCalls/{id}', [AgentCallsController::class, 'update'])->name('AgentCalls.update');
    Route::delete('AgentCalls/{id}', [AgentCallsController::class, 'destroy'])->name('AgentCalls.destroy');


   Route::get('/hotelsCalls', [HotelCallsController::class, 'index'])->name('hotelsCalls');
   Route::match(['get','post'],'/hotelsCalls/create', [HotelCallsController::class, 'create'])->name('add_hotelsCalls');
   Route::get('hotelsCalls/{id}/edit', [HotelCallsController::class, 'edit'])->name('hotelsCalls.edit');
    Route::put('hotelsCalls/{id}', [HotelCallsController::class, 'update'])->name('hotelsCalls.update');
    Route::delete('hotelsCalls/{id}', [HotelCallsController::class, 'destroy'])->name('hotelsCalls.destroy');


   Route::get('/customer-calls', [CustomerCallsController::class, 'index'])->name('customerCalls');
   Route::match(['get','post'],'/customer/create', [CustomerCallsController::class, 'create'])->name('add_customer');
   Route::get('customer/{id}/edit', [CustomerCallsController::class, 'edit'])->name('customer.edit');
    Route::put('customer/{id}', [CustomerCallsController::class, 'update'])->name('customer.update');
    Route::delete('customer/{id}', [CustomerCallsController::class, 'destroy'])->name('customer.destroy');


    Route::get('/vehicle', [VehicleController::class, 'index'])->name('vehicle');
    Route::match(['get','post'],'/vehicle/create', [VehicleController::class, 'create'])->name('vehicle_crete');
    Route::get('vehicle/{id}/edit', [VehicleController::class, 'edit'])->name('vehicle.edit');
    Route::put('vehicle/{id}', [VehicleController::class, 'update'])->name('vehicle.update');
    Route::delete('vehicle/{id}', [VehicleController::class, 'destroy'])->name('vehicle.destroy');
    Route::patch('/vehicle/{id}/status', [VehicleController::class, 'updateStatus'])->name('vehicle.updateStatus');


    Route::get('/booking', [BookingController::class, 'index'])->name('booking');
    Route::post('/booking/create', [BookingController::class, 'create'])->name('booking_crete');

    Route::get('/agent', [AgentController::class, 'index'])->name('agent');
    Route::post('/agent/create', [AgentController::class, 'create'])->name('agent.create');

    Route::get('/taxi-booking', [TaxiBookingController::class, 'index'])->name('taxi_booking');
    Route::post('/taxi-booking/create', [TaxiBookingController::class, 'create'])->name('taxi-booking.create');


    Route::get('notification', [PushNotificationController::class, 'index'])->name('notification');

    Route::get('notification/create/{id?}', [PushNotificationController::class, 'create'])->name('notificationcreate');

    Route::post('notification/store', [PushNotificationController::class, 'store'])->name('notificationstore');
  
});
   
});


