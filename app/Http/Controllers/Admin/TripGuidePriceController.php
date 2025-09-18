<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehiclePrice;
use App\Models\Outstation;
use App\Models\Languages;
use App\Models\RoundTrip;
use App\Models\WildlifeSafari;
use App\Models\TripGuidePrice;
use App\Models\State;
use App\Models\TripGuideBook;
use App\Models\City;
use App\Models\TripGuideBook2;
use App\Models\TransferGuideOrder;
use App\Models\RemarkGuideOrder;
use App\adminmodel\Team;
use App\Models\Tourist;
use App\Models\TripGuide;
use Illuminate\Support\Facades\Auth;


class TripGuidePriceController extends Controller
{

    function index($id) {
        $data['trip'] = TripGuide::where('id',$id)->first();
        $data['trip_price'] = TripGuidePrice::where('trip_id',$id)->orderBy('id','DESC')->get();
        return view('admin/tripguide_price/index',$data);
    }
    

    public function create(Request $request, $id)
{
    if ($request->isMethod('post')) {
        $validated = $request->validate([
            'price_1_to_4' => 'required|numeric',
            'price_5' => 'required|numeric',
            'price_6' => 'required|numeric',
            'price_6_to_10' => 'required|numeric',
        ]);

        $tripGuidePrice = new TripGuidePrice();
        $tripGuidePrice->trip_id = $id;
        $tripGuidePrice->price_1_to_4 = $request->input('price_1_to_4');
        $tripGuidePrice->price_5 = $request->input('price_5');
        $tripGuidePrice->price_6 = $request->input('price_6');
        $tripGuidePrice->price_6_to_10 = $request->input('price_6_to_10');

        // Optional: link to some $id if needed (e.g., $tripGuidePrice->vehicle_id = $id)

        $tripGuidePrice->save();

        return redirect()->route('tripguide_price',$id)->with('success', 'Trip Guide Price added successfully!');
    }

    $data['TripGuide'] = TripGuide::where('id',$id)->first();
    return view('admin.tripguide_price.create', $data);
}


    public function destroy($id)
    {
        $agentCall = TripGuidePrice::findOrFail($id); // Find the agent call by ID
        $agentCall->delete(); 

        return redirect()->back()->with('success', 'Trip Guide Price deleted successfully!');
    }


    public function edit($id)
    {
        $data['guide'] = TripGuidePrice::findOrFail($id);
        $data['states'] = State::all(); 
        $data['languages'] = Languages::all();
        // $data['cities'] = City::where('state_id', $data['wildlifeSafari']->state_id)->get(); 

        return view('admin/tripguide_price/edit',$data);
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'price_1_to_4' => 'required|numeric',
            'price_5' => 'required|numeric',
            'price_6' => 'required|numeric',
            'price_6_to_10' => 'required|numeric',
        ]);
    
        $tripGuidePrice = TripGuidePrice::findOrFail($id);

        $tripGuidePrice->trip_id = $id;
        $tripGuidePrice->price_1_to_4 = $request->input('price_1_to_4');
        $tripGuidePrice->price_5 = $request->input('price_5');
        $tripGuidePrice->price_6 = $request->input('price_6');
        $tripGuidePrice->price_6_to_10 = $request->input('price_6_to_10');
        $tripGuidePrice->save();

        return redirect()->route('tripguide_price',$tripGuidePrice->id)->with('success', 'Trip Guide Price updated successfully!');
    }

    public function updateStatus($id)
    {
        $vehicle = TripGuidePrice::findOrFail($id);
        $vehicle->status = ($vehicle->status == 1) ? 2 : 1;
        $vehicle->save();

        return redirect()->route('tripguide   ')->with('success', 'Outstation status updated successfully!');
    }

}
