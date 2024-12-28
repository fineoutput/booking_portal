<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaxiBooking;


class TaxiBookingController extends Controller
{
    function index(){
        $data['agent'] = TaxiBooking::orderBy('id','DESC')->get();
        return view('admin/textbooking/index',$data);
    }
}
