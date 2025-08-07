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
use App\Models\LocationCost;
use Illuminate\Support\Facades\DB;

class PackageLocationController extends Controller
{
  


//    public function update(Request $request, $id)
//     {
//         if ($request->isMethod('get')) {
//             $locationCosts = LocationCost::where('package_id', $id)->get();
//             return view('admin.PackageLocation.create', compact('locationCosts', 'id'));
//         }

//         $validated = $request->validate([
//             'locations.*' => 'required|string|max:255',
//             'costs.*' => 'required|numeric|min:0',
//             'vehicle.*' => 'required|string|max:255',
//         ]);

//         if (count($request->locations) !== count(array_unique($request->locations))) {
//             return redirect()->back()->withErrors(['locations' => 'Duplicate locations are not allowed.'])->withInput();
//         }

//         \DB::transaction(function () use ($request, $id) {
//             $existingEntries = LocationCost::where('package_id', $id)->get()->keyBy('location');
//             $processedLocations = [];

//             foreach ($request->locations as $index => $location) {
//                 $cost = $request->costs[$index];
//                 $vehicle = $request->vehicle[$index];
//                 $processedLocations[] = $location;

//                 if ($existingEntries->has($location)) {
//                     $existing = $existingEntries[$location];
//                     $existing->update([
//                         'cost' => $cost,
//                         'vehicle' => $vehicle,
//                     ]);
//                 } else {
//                     LocationCost::create([
//                         'package_id' => $id,
//                         'location' => $location,
//                         'cost' => $cost,
//                         'vehicle' => $vehicle,
//                     ]);
//                 }
//             }

//             LocationCost::where('package_id', $id)
//                 ->whereNotIn('location', $processedLocations)
//                 ->delete();
//         });

//         return redirect()->route('package_price', ['id' => $id])->with('success', 'Location & cost updated successfully.');
//     }



public function update(Request $request, $id)
    {
        if ($request->isMethod('get')) {
            $locationCosts = LocationCost::where('package_id', $id)->get();
            return view('admin.PackageLocation.create', compact('locationCosts', 'id'));
        }

        // Validate the request
        $validated = $request->validate([
            'locations.*' => 'required|string|max:255',
            'vehicles.*.*' => 'required|string|max:255',
            'costs.*.*' => 'required|numeric|min:0',
        ]);

        // Check for duplicate locations
        if (count($request->locations) !== count(array_unique($request->locations))) {
            return redirect()->back()->withErrors(['locations' => 'Duplicate locations are not allowed.'])->withInput();
        }

        // Check for duplicate vehicles within each location
        foreach ($request->vehicles as $index => $vehicles) {
            if (count($vehicles) !== count(array_unique($vehicles))) {
                return redirect()->back()->withErrors(['vehicles.' . $index => 'Duplicate vehicles are not allowed within the same location.'])->withInput();
            }
        }

        // Ensure arrays are aligned
        foreach ($request->locations as $index => $location) {
            if (!isset($request->vehicles[$index]) || !isset($request->costs[$index]) ||
                count($request->vehicles[$index]) !== count($request->costs[$index])) {
                return redirect()->back()->withErrors(['general' => 'Mismatched vehicle and cost data for location ' . $location])->withInput();
            }
        }

        DB::transaction(function () use ($request, $id) {
            // Get existing entries
            $existingEntries = LocationCost::where('package_id', $id)->get()->groupBy('location');
            $processedLocations = [];

            foreach ($request->locations as $index => $location) {
                $vehicles = $request->vehicles[$index];
                $costs = $request->costs[$index];
                $processedLocations[] = $location;

                // Get existing entries for this location
                $existingForLocation = $existingEntries->get($location, collect())->keyBy('vehicle');

                foreach ($vehicles as $vIndex => $vehicle) {
                    $cost = $costs[$vIndex];

                    if ($existingForLocation->has($vehicle)) {
                        // Update existing entry
                        $existing = $existingForLocation[$vehicle];
                        $existing->update([
                            'cost' => $cost,
                            'vehicle' => $vehicle,
                        ]);
                    } else {
                        // Create new entry
                        LocationCost::create([
                            'package_id' => $id,
                            'location' => $location,
                            'vehicle' => $vehicle,
                            'cost' => $cost,
                        ]);
                    }
                }

                // Remove vehicles that are no longer present
                LocationCost::where('package_id', $id)
                    ->where('location', $location)
                    ->whereNotIn('vehicle', $vehicles)
                    ->delete();
            }

            // Remove locations that are no longer present
            LocationCost::where('package_id', $id)
                ->whereNotIn('location', $processedLocations)
                ->delete();
        });

        return redirect()->route('package_price', ['id' => $id])->with('success', 'Location & cost updated successfully.');
    }



}
