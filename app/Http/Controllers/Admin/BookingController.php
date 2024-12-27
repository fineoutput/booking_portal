<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    function index(){
        $data['agent'] = Booking::orderBy('id','DESC')->get();
        return view('admin/booking/index',$data);
    }
}
