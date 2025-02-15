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
use App\Http\Controllers\Admin\WildlifeSafariOrderController;
use App\Http\Controllers\Admin\HotelsController;
use App\Http\Controllers\Admin\VehiclePriceController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PackagePriceController;
use App\Http\Controllers\Admin\AgentCallsController;
use App\Http\Controllers\Admin\HotelCallsController;
use App\Http\Controllers\Admin\HotelsPriceController;
use App\Http\Controllers\Admin\TaxiBookingController;
use App\Http\Controllers\Admin\HotelBookingController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\ConstantsController;
use App\Http\Controllers\Admin\CustomerCallsController;
use App\Http\Controllers\Admin\TripGuideController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\WildlifeSafariController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\PushNotificationController;
use App\Http\Controllers\Admin\OutstationController;
use App\Http\Controllers\Admin\RoundTripController;
use App\Http\Controllers\Auth\adminlogincontroller;
use App\Models\WildlifeSafari;

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

   Route::get('/pandin-hotels-booking', [HotelBookingController::class, 'index'])->name('pandinghotelsbooking');
   Route::get('/complete-hotels-booking', [HotelBookingController::class, 'completeorders'])->name('completehotelsbooking');
   Route::match(['put', 'patch'], '/hotels-booking/{id}/status', [HotelBookingController::class, 'updateStatus'])->name('hotelsbooking.updateStatus');


   //  Hotels  ------------------------
   Route::get('/hotels', [HotelsController::class, 'index'])->name('hotels');
   Route::match(['get','post'],'/hotels/create', [HotelsController::class, 'create'])->name('add_hotels');
   Route::get('hotels/{hotel}/edit', [HotelsController::class, 'edit'])->name('hotels.edit');
    Route::put('hotels/{hotel}', [HotelsController::class, 'update'])->name('hotels.update');
    Route::delete('hotels/{hotel}', [HotelsController::class, 'destroy'])->name('hotels.destroy');
    Route::get('/cities/{stateId}', [HotelsController::class, 'getCitiesByStatehotels']);

    Route::get('/hotel-price/{id}', [HotelsPriceController::class, 'index'])->name('hotel_price');
    Route::match(['get','post'],'/hotel/price/create/{id}', [HotelsPriceController::class, 'create'])->name('hotel_price_create');
    Route::delete('/hotel-price/{id}', [HotelsPriceController::class, 'destroy'])->name('hotel_price.destroy');
    Route::get('hotel-price/{id}/edit', [HotelsPriceController::class, 'edit'])->name('hotel_price.edit');
    Route::put('hotel-price/{id}', [HotelsPriceController::class, 'update'])->name('hotel_price.update');


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
//    Route::get('/cities/{stateId}', [PackageController::class, 'getCitiesByState']);
Route::get('/cities', [PackageController::class, 'getCitiesByState']);


   Route::get('/package-price/{id}', [PackagePriceController::class, 'index'])->name('package_price');
   Route::match(['get','post'],'/package/price/create/{id}', [PackagePriceController::class, 'create'])->name('package_price_create');
   Route::delete('/package-price/{id}', [PackagePriceController::class, 'destroy'])->name('package_price.destroy');
   Route::get('package-price/{id}/edit', [PackagePriceController::class, 'edit'])->name('package_price.edit');
   Route::put('package-price/{id}', [PackagePriceController::class, 'update'])->name('package_price.update');
   Route::get('/cities/{stateId}', [PackagePriceController::class, 'getCitiesByState']);



   Route::get('/AgentCalls', [AgentCallsController::class, 'index'])->name('AgentCalls');
   Route::match(['get','post'],'/AgentCalls/create', [AgentCallsController::class, 'create'])->name('add_AgentCalls');
   Route::get('AgentCalls/{id}/edit', [AgentCallsController::class, 'edit'])->name('AgentCalls.edit');
    Route::put('AgentCalls/{id}', [AgentCallsController::class, 'update'])->name('AgentCalls.update');
    Route::delete('AgentCalls/{id}', [AgentCallsController::class, 'destroy'])->name('AgentCalls.destroy');
    Route::get('/cities/{stateId}', [AgentCallsController::class, 'getCitiesByStateagent']);


    Route::match(['get','post'],'/set-constants', [ConstantsController::class, 'create'])->name('set_constants');

   Route::get('/hotelsCalls', [HotelCallsController::class, 'index'])->name('hotelsCalls');
   Route::match(['get','post'],'/hotelsCalls/create', [HotelCallsController::class, 'create'])->name('add_hotelsCalls');
   Route::get('hotelsCalls/{id}/edit', [HotelCallsController::class, 'edit'])->name('hotelsCalls.edit');
    Route::put('hotelsCalls/{id}', [HotelCallsController::class, 'update'])->name('hotelsCalls.update');
    Route::delete('hotelsCalls/{id}', [HotelCallsController::class, 'destroy'])->name('hotelsCalls.destroy');
    Route::get('/cities/{stateId}', [HotelCallsController::class, 'getCitiesByStatehotelcalls']);


   Route::get('/customer-calls', [CustomerCallsController::class, 'index'])->name('customerCalls');
   Route::get('/customer-calls/ongoing', [CustomerCallsController::class, 'Ongoing'])->name('OngoingcustomerCalls');
   Route::get('/customer-calls/cancelled', [CustomerCallsController::class, 'Cancelled'])->name('CancelledcustomerCalls');
   Route::get('/customer-calls/converted', [CustomerCallsController::class, 'Converted'])->name('ConvertedcustomerCalls');
   Route::match(['get','post'],'/customer/create', [CustomerCallsController::class, 'create'])->name('add_customer');
   Route::get('customer/{id}/edit', [CustomerCallsController::class, 'edit'])->name('customer.edit');
    Route::put('customer/{id}', [CustomerCallsController::class, 'update'])->name('customer.update');
    Route::delete('customer/{id}', [CustomerCallsController::class, 'destroy'])->name('customer.destroy');
    Route::get('/cities/{stateId}', [CustomerCallsController::class, 'getCitiesByStatecustomer']);


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

    Route::get('/panding-agent', [AgentController::class, 'pandingagent'])->name('pandingagent');
    Route::get('/complete-agent', [AgentController::class, 'completeagent'])->name('completegagent');
    Route::match(['put', 'patch'], '/agent/{id}/status', [AgentController::class, 'updateStatus'])->name('agent.updateStatus');

    Route::get('/taxi-booking', [TaxiBookingController::class, 'index'])->name('taxi-booking');
    Route::post('/taxi-booking/create', [TaxiBookingController::class, 'create'])->name('taxi-booking.create');


    Route::get('notification', [PushNotificationController::class, 'index'])->name('notification');

    Route::get('notification/create/{id?}', [PushNotificationController::class, 'create'])->name('notificationcreate');

    Route::post('notification/store', [PushNotificationController::class, 'store'])->name('notificationstore');


   // WildlifeSafari

    Route::get('/wild-life-safari', [WildlifeSafariController::class, 'index'])->name('wild_life_safari');
    Route::match(['get','post'],'/wild-life-safari/create', [WildlifeSafariController::class, 'create'])->name('wild_life_safari_create');
    Route::get('wild-life-safari/{id}/edit', [WildlifeSafariController::class, 'edit'])->name('wild_life_safari.edit');
    Route::put('wild-life-safari/{id}', [WildlifeSafariController::class, 'update'])->name('wild_life_safari.update');
    Route::delete('wild-life-safari/{id}', [WildlifeSafariController::class, 'destroy'])->name('wild_life_safari.destroy');
    Route::patch('/wild-life-safari/{id}/status', [WildlifeSafariController::class, 'updateStatus'])->name('wild_life_safari.updateStatus');
    Route::get('/safari/cities/{stateId}', [WildlifeSafariController::class, 'getCitiesByStatesafari']);


    Route::get('/wild-life-safari-order', [WildlifeSafariOrderController::class, 'index'])->name('wild_life_safari_orders');

    Route::get('/complete-wild-life-safari-order', [WildlifeSafariOrderController::class, 'completeorders'])->name('wild_life_safari_orders_complete');

    Route::match(['get','post'],'/wild-life-safari-order/create', [WildlifeSafariOrderController::class, 'create'])->name('wild_life_safari_create_order');

    Route::get('wild-life-safari-order/{id}/edit', [WildlifeSafariOrderController::class, 'edit'])->name('wild_life_safari_order.edit');

    Route::put('wild-life-safari-order/{id}', [WildlifeSafariOrderController::class, 'update'])->name('wild_life_safari_order.update');

    Route::delete('wild-life-safari-order/{id}', [WildlifeSafariOrderController::class, 'destroy'])->name('wild_life_safari_order.destroy');

    Route::put('/wild-life-safari-order/{id}/status', [WildlifeSafariOrderController::class, 'updateStatus'])->name('wild_life_safari_order.updateStatus');

    // Route::get('/safari/cities/{stateId}', [WildlifeSafariOrderController::class, 'getCitiesByStatesafariorder']);

   // TripGuide

    Route::get('/trip-guide', [TripGuideController::class, 'index'])->name('tripguide');
    Route::match(['get','post'],'/trip-guide/create', [TripGuideController::class, 'create'])->name('tripguide_create');
    Route::get('trip-guide/{id}/edit', [TripGuideController::class, 'edit'])->name('tripguide.edit');
    Route::put('trip-guide/{id}', [TripGuideController::class, 'update'])->name('tripguide.update');
    Route::delete('trip-guide/{id}', [TripGuideController::class, 'destroy'])->name('tripguide.destroy');
    Route::patch('/trip-guide/{id}/status', [TripGuideController::class, 'updateStatus'])->name('tripguide.updateStatus');
    Route::get('/trip-guide/cities/{stateId}', [TripGuideController::class, 'getCitiesByStatetripguide']);
  
});
   
});


