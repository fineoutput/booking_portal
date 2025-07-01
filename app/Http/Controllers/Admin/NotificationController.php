<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HotelPrefrence;
use App\Models\Package;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Storage;

class NotificationController extends Controller
{
    // public function index() {
    //     $data['hotels'] = HotelPrefrence::orderBy('id','DESC')->get();
    //     return view('admin/hotelsNotification/index',$data);
    // }

    function index() {
            $data['UpgradeRequest'] = HotelPrefrence::orderBy('id','DESC')->get();
            return view('admin/hotelsNotification/index',$data);
    }

}

