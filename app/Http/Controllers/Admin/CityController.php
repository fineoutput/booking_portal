<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminCity;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackagePrice;
use App\Models\City;
use App\Models\HotelPrice;
use App\Models\Hotels;
use App\Models\State;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CityController extends Controller
{
    function index(){
        $data['city'] = AdminCity::orderBy('id','DESC')->get();
        return view('admin/city/index',$data);
    }

    public function getCitiesByState($stateId)
    {
    $cities = City::where('state_id', $stateId)->get(['id', 'city_name']);
    return response()->json(['cities' => $cities]);
    }


    public function create(Request $request)
    {
        if ($request->method() == 'POST') {
            // Validate the incoming request
            $request->validate([
                'state_id' => 'required',
                'city_name' => 'required',
            ]);
    
                $packagePrice = new AdminCity();
                $packagePrice->state_id = $request->state_id;
                $packagePrice->city_name = $request->city_name;
                $packagePrice->status = 0;
              
                $packagePrice->save();
    
                $message = 'City added successfully.';

            return redirect()->route('city.index')
                 ->with('success', $message);

        }
    
        $data['state'] = State::all();
        return view('admin/city/create', $data);
    }
    public function destroy($id)
    {
        $package = AdminCity::findOrFail($id);

        $package->delete();
        return redirect()->back()->with('success', 'City deleted successfully.');
    }


        public function edit($id)
        {
            // Retrieve the package by its ID
            $data['city'] = AdminCity::findOrFail($id);
            $data['state'] = State::all();

            // Pass the package data to the edit view
            return view('admin/city/edit',$data);
        }


        public function update(Request $request, $id)
        {
            $request->validate([
                'state_id' => 'required',
                'city_name' => 'required',
               
            ]);
        
            $packagePrice = AdminCity::findOrFail($id);
        
                $packagePrice->state_id = $request->state_id;
                $packagePrice->city_name = $request->city_name;
                $packagePrice->status = 0;
                
                $packagePrice->save();
        
            return redirect()->route('city.index')->with('success', 'City updated successfully.');
        }

}
