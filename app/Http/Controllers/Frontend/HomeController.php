<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Redirect;
use Laravel\Sanctum\PersonalAccessToken;
use DateTime;


class HomeController extends Controller
{
    // ============================= START INDEX ============================ 
    public function index(Request $req)
    {
     
        return view('front/index')->withTitle('home');
    }
    public function login()
    {
        return view('front/login');
    }
    public function options()
    {
        return view('front/options');
    }
    public function confirmation()
    {
        return view('front/confirmation');
    }
    public function user_profile()
    {
        return view('front/user_profile');
    }
    public function taxi_booking()
    {
        return view('front/taxi_booking');
    }
    public function list()
    {
        return view('front/list');
    }
    
}
