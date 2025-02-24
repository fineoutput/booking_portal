<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaxiBooking;


class TaxiBookingController extends Controller
{
    function index(){
        $data['agent'] = TaxiBooking::orderBy('id','DESC')->where('tour_type','Airport/Railway station')->get();
        return view('admin/textbooking/index',$data);
    }
    function localtourindex(){
        $data['agent'] = TaxiBooking::orderBy('id','DESC')->where('tour_type','Local Tour')->get();
        return view('admin/textbooking/localtour',$data);
    }
    function outstationindex(){
        $data['agent'] = TaxiBooking::orderBy('id','DESC')->where('tour_type','Outstation')->get();
        return view('admin/textbooking/outstation',$data);
    }
}
