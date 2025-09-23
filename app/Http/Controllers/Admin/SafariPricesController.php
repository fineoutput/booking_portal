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
use App\Models\SafariPrices;
use Illuminate\Support\Facades\Auth;


class SafariPricesController extends Controller
{

    function index($id) {
        $data['safari'] = WildlifeSafari::where('id',$id)->first();
        $data['safari_price'] = SafariPrices::where('safari_id',$id)->orderBy('id','DESC')->get();
        return view('admin/safari_prices/index',$data);
    }
    

    public function create(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'visitor_type' => 'required',
                'day_type' => 'required',
                'price_type' => 'required',
                'price' => 'required',
            ]);

            $safari = new SafariPrices();
            $safari->safari_id = $id;
            $safari->start_month = $request->input('start_month');
            $safari->end_month = $request->input('end_month');
            $safari->visitor_type = $request->input('visitor_type');
            $safari->day_type = $request->input('day_type');
            $safari->price_type = $request->input('price_type');
            $safari->price = $request->input('price');

            $safari->save();

            return redirect()->route('safari_prices',$id)->with('success', 'Safari Price added successfully!');
        }

        $data['WildlifeSafari'] = WildlifeSafari::where('id',$id)->first();
        return view('admin.safari_prices.create', $data);
    }


    public function destroy($id)
    {
        $agentCall = SafariPrices::findOrFail($id); // Find the agent call by ID
        $agentCall->delete(); 

        return redirect()->back()->with('success', 'Safari Price deleted successfully!');
    }


    public function edit($id)
    {
        $data['SafariPrices'] = SafariPrices::findOrFail($id);
        $data['states'] = State::all(); 
        $data['languages'] = Languages::all();
        // $data['cities'] = City::where('state_id', $data['wildlifeSafari']->state_id)->get(); 

        return view('admin/safari_prices/edit',$data);
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'visitor_type' => 'required',
                'day_type' => 'required',
                'price_type' => 'required',
                'price' => 'required',
        ]);
    
        $safari = SafariPrices::findOrFail($id);

        $safari->safari_id = $id;
        $safari->start_month = $request->input('start_month');
        $safari->end_month = $request->input('end_month');
        $safari->visitor_type = $request->input('visitor_type');
        $safari->day_type = $request->input('day_type');
        $safari->price_type = $request->input('price_type');
        $safari->price = $request->input('price');
        $safari->save();

        return redirect()->route('safari_prices',$safari->id)->with('success', 'Safari Price updated successfully!');
    }

    public function updateStatus($id)
    {
        $safari = SafariPrices::findOrFail($id);
        $safari->status = ($safari->status == 1) ? 2 : 1;
        $safari->save();

        return redirect()->route('tripguide   ')->with('success', 'Outstation status updated successfully!');
    }

}
