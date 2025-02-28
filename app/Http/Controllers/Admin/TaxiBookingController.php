<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaxiBooking;
use App\Models\TaxiBooking2;


class TaxiBookingController extends Controller
{
    function index(){
        $data['agent'] = TaxiBooking2::orderBy('id','DESC')->where('status',0)->where('tour_type','Airport/Railway station')->get();
        return view('admin/textbooking/index',$data);
    }

    function rejectindex(){
        $data['agent'] = TaxiBooking2::orderBy('id','DESC')->where('status',2)->where('tour_type','Airport/Railway station')->get();
        return view('admin/textbooking/index',$data);
    }

    function completeindex(){
        $data['agent'] = TaxiBooking2::orderBy('id','DESC')->where('status',1)->where('tour_type','Airport/Railway station')->get();
        return view('admin/textbooking/index',$data);
    }

    public function updateStatus($id)
    {
        $vehicle = TaxiBooking2::findOrFail($id);
    
        // Check the action from the form
        $action = request()->input('status_action');
    
        if ($action == 'complete') {
            // Change status to 1 (Confirmed)
            $vehicle->status = 1;
        } elseif ($action == 'cancel') {
            // Change status to 2 (Canceled)
            $vehicle->status = 2;
        } else {
            // Default case, no action (status might not change)
            return redirect()->back()->with('error', 'Invalid status update action.');
        }
    
        // Save the changes
        $vehicle->save();
    
        return redirect()->back()->with('success', 'Safari Order status updated successfully!');
    }

    function localtourindex(){
        $data['agent'] = TaxiBooking2::orderBy('id','DESC')->where('status',0)->where('tour_type','Local Tour')->get();
        return view('admin/textbooking/localtour',$data);
    }

    function completelocaltourindex(){
        $data['agent'] = TaxiBooking2::orderBy('id','DESC')->where('status',1)->where('tour_type','Local Tour')->get();
        return view('admin/textbooking/localtour',$data);
    }

    function rejectlocaltourindex(){
        $data['agent'] = TaxiBooking2::orderBy('id','DESC')->where('status',2)->where('tour_type','Local Tour')->get();
        return view('admin/textbooking/localtour',$data);
    }

    function outstationindex(){
        $data['agent'] = TaxiBooking2::orderBy('id','DESC')->where('status',0)->where('tour_type','Outstation')->get();
        return view('admin/textbooking/outstation',$data);
    }

    function rejectoutstationindex(){
        $data['agent'] = TaxiBooking2::orderBy('id','DESC')->where('status',2)->where('tour_type','Outstation')->get();
        return view('admin/textbooking/outstation',$data);
    }

    function completeoutstationindex(){
        $data['agent'] = TaxiBooking2::orderBy('id','DESC')->where('status',1)->where('tour_type','Outstation')->get();
        return view('admin/textbooking/outstation',$data);
    }

}
