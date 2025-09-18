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

        return redirect()->route('tripguide_price',$id)->with('success', 'Trip Guide added successfully!');
    }

    $data['TripGuide'] = TripGuide::where('id',$id)->first();
    return view('admin.tripguide_price.create', $data);
}


    public function destroy($id)
    {
        $agentCall = TripGuidePrice::findOrFail($id); // Find the agent call by ID
        $agentCall->delete(); 

        return redirect()->back()->with('success', 'Trip Guide deleted successfully!');
    }


    public function edit($id)
    {
        $data['wildlifeSafari'] = TripGuidePrice::findOrFail($id);
        $data['states'] = State::all(); 
        $data['languages'] = Languages::all();
        $data['cities'] = City::where('state_id', $data['wildlifeSafari']->state_id)->get(); 

        return view('admin/tripguide_price/edit',$data);
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'state_id' => 'required',
            'city_id' => 'required',
            'cost' => 'required|numeric',
        ]);
    
        // Find the WildlifeSafari entry
        $wildlifeSafari = TripGuidePrice::findOrFail($id);

        $imagePaths = json_decode($wildlifeSafari->image, true) ?? [];

        if ($request->has('deleted_images')) {
            $deletedImages = explode(',', $request->deleted_images);
    
            $this->deleteFiles($deletedImages);
    
            $imagePaths = array_diff($imagePaths, $deletedImages);
        }
    
        if ($request->hasFile('image')) {
    
            foreach ($request->file('image') as $image) {
                
                $destinationPath = public_path('uploads/image/trip_guide/');
    
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);  
                }
        
                $filename = time() . '_' . $image->getClientOriginalName();
                
                $image->move($destinationPath, $filename);
                
                $imagePaths[] = 'uploads/image/trip_guide/' . $filename;
            }
        }
    
        // Update the record
        $wildlifeSafari->location = $request->location;
        $wildlifeSafari->out_station_guide = $request->out_station_guide;
        $wildlifeSafari->languages_id = $request->languages_id;
        $wildlifeSafari->local_guide = $request->local_guide;
        $wildlifeSafari->city_id = $request->city_id;
        $wildlifeSafari->description = $request->description;
        $wildlifeSafari->state_id = $request->state_id;
        $wildlifeSafari->cost = $request->cost;
        $wildlifeSafari->image = json_encode(array_values($imagePaths)); 

        $wildlifeSafari->guide_type = is_array($request->guide_type) ? implode(',', $request->guide_type) : $request->guide_type;
        
        $wildlifeSafari->save();

        return redirect()->route('tripguide')->with('success', 'Trip Guide updated successfully!');
    }

    public function updateStatus($id)
    {
        $vehicle = TripGuidePrice::findOrFail($id);
        $vehicle->status = ($vehicle->status == 1) ? 2 : 1;
        $vehicle->save();

        return redirect()->route('tripguide   ')->with('success', 'Outstation status updated successfully!');
    }

}
