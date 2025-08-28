<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackagePrice;
use App\Models\City;
use App\Models\State;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\VehicleCost;

class VehicleCostController extends Controller
{
  

  public function create(Request $request, $id)
    {

        if ($request->isMethod('get')) {
            $vehicleCost = VehicleCost::where('package_id', $id)->first(); 

            return view('admin/vehiclecost/create', compact('vehicleCost', 'id'));
        }

        $request->validate([
            'hatchback_cost' => 'nullable|numeric',
            'sedan_cost' => 'nullable|numeric',
            'economy_suv_cost' => 'nullable|numeric',
            // 'luxury_sedan_cost' => 'nullable|numeric',
            // 'suv_cost' => 'nullable|numeric',
            'luxury_suv_cost' => 'nullable|numeric',
            'traveller_mini_cost' => 'nullable|numeric',
            'traveller_big_cost' => 'nullable|numeric',
            'premium_traveller_cost' => 'nullable|numeric',
            // 'muv_cost' => 'nullable|numeric',
            'bus_nonac_cost' => 'nullable|numeric',
            'ac_coach_cost' => 'nullable|numeric',
        ]);

        $vehicleCost = VehicleCost::updateOrCreate(
            ['package_id' => $id],
            [
                'hatchback_cost' => $request->hatchback_cost,
                'sedan_cost' => $request->sedan_cost,
                'economy_suv_cost' => $request->economy_suv_cost,
                'luxury_sedan_cost' => $request->luxury_sedan_cost,
                'suv_cost' => $request->suv_cost,
                'luxury_suv_cost' => $request->luxury_suv_cost,
                'traveller_mini_cost' => $request->traveller_mini_cost,
                'traveller_big_cost' => $request->traveller_big_cost,
                'premium_traveller_cost' => $request->premium_traveller_cost,
                'muv_cost' => $request->muv_cost,
                'bus_nonac_cost' => $request->bus_nonac_cost,
                'ac_coach_cost' => $request->ac_coach_cost,
            ]
        );

        return redirect()->route('package_price', ['id' => $id])->with('success', 'Vehicle cost saved successfully.');
    }



}
