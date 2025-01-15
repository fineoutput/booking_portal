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
use App\Http\Controllers\Admin\VehiclePriceController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\AgentCallsController;
use App\Http\Controllers\Admin\HotelCallsController;
use App\Http\Controllers\Admin\TaxiBookingController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\CustomerCallsController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\PushNotificationController;
use App\Http\Controllers\Admin\OutstationController;
use App\Http\Controllers\Admin\RoundTripController;
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
    Route::get('/cities/{stateId}', [HotelsController::class, 'getCitiesByStatehotels']);


   Route::get('/route', [RouteController::class, 'index'])->name('route');
   Route::match(['get','post'],'/route/create', [RouteController::class, 'create'])->name('add_route');
   Route::get('route/{id}/edit', [RouteController::class, 'edit'])->name('route.edit');
    Route::put('route/{id}', [RouteController::class, 'update'])->name('route.update');
    Route::delete('route/{id}', [RouteController::class, 'destroy'])->name('route.destroy');
    // Route::get('/cities/{stateId}', [RouteController::class, 'getCitiesByStatehotels']);
   
   // Package --------------------------
   Route::get('/package', [PackageController::class, 'index'])->name('package');
   Route::match(['get','post'],'/package/create', [PackageController::class, 'create'])->name('add_package');
   Route::delete('/packages/{id}', [PackageController::class, 'destroy'])->name('packages.destroy');
   Route::get('packages/{id}/edit', [PackageController::class, 'edit'])->name('packages.edit');
   Route::put('packages/{id}', [PackageController::class, 'update'])->name('packages.update');
   Route::get('/cities/{stateId}', [PackageController::class, 'getCitiesByState']);



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
   Route::get('/customer-calls/ongoing', [CustomerCallsController::class, 'Ongoing'])->name('OngoingcustomerCalls');
   Route::get('/customer-calls/cancelled', [CustomerCallsController::class, 'Cancelled'])->name('CancelledcustomerCalls');
   Route::get('/customer-calls/converted', [CustomerCallsController::class, 'Converted'])->name('ConvertedcustomerCalls');
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


    Route::get('/outstation', [OutstationController::class, 'index'])->name('outstation');
    Route::match(['get','post'],'/outstation/create', [OutstationController::class, 'create'])->name('outstation_create');
    Route::get('outstation/{id}/edit', [OutstationController::class, 'edit'])->name('outstation.edit');
    Route::put('outstation/{id}', [OutstationController::class, 'update'])->name('outstation_update');
    Route::delete('outstation/{id}', [OutstationController::class, 'destroy'])->name('outstation.destroy');
    Route::patch('/outstation/{id}/status', [OutstationController::class, 'updateStatus'])->name('outstation.updateStatus');


    Route::get('/roundtrip', [RoundTripController::class, 'index'])->name('roundtrip');
    Route::match(['get','post'],'/roundtrip/create', [RoundTripController::class, 'create'])->name('roundtrip_crete');
    Route::get('roundtrip/{id}/edit', [RoundTripController::class, 'edit'])->name('roundtrip.edit');
    Route::put('roundtrip/{id}', [RoundTripController::class, 'update'])->name('roundtrip_update');
    Route::delete('roundtrip/{id}', [RoundTripController::class, 'destroy'])->name('roundtrip.destroy');
    Route::patch('/roundtrip/{id}/status', [RoundTripController::class, 'updateStatus'])->name('roundtrip.updateStatus');


    Route::get('/vehicle-price/{id}', [VehiclePriceController::class, 'vehicleprice'])->name('vehicleprice');
    Route::match(['get','post'],'/vehicle-price/create/{id}', [VehiclePriceController::class, 'vehiclepricecreate'])->name('vehiclepricecreate');
    Route::get('/vehicle-price-edit/{id}', [VehiclePriceController::class, 'vehiclepriceedit'])->name('vehiclepriceedit');
    Route::put('/vehicle-price-update/{id}', [VehiclePriceController::class, 'vehiclepriceupdate'])->name('vehiclepriceupdate');
    Route::delete('/vehicle-price-delete/{id}', [VehiclePriceController::class, 'vehiclepricedelete'])->name('vehiclepricedelete');


    Route::get('/booking', [BookingController::class, 'index'])->name('booking');
    Route::post('/booking/create', [BookingController::class, 'create'])->name('booking_crete');

    Route::get('/agent', [AgentController::class, 'index'])->name('agent');
    Route::post('/agent/create', [AgentController::class, 'create'])->name('agent.create');

    Route::get('/taxi-booking', [TaxiBookingController::class, 'index'])->name('taxi-booking');
    Route::post('/taxi-booking/create', [TaxiBookingController::class, 'create'])->name('taxi-booking.create');


    Route::get('notification', [PushNotificationController::class, 'index'])->name('notification');

    Route::get('notification/create/{id?}', [PushNotificationController::class, 'create'])->name('notificationcreate');

    Route::post('notification/store', [PushNotificationController::class, 'store'])->name('notificationstore');
  
});
   
});


