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

class PackageLocationController extends Controller
{
  


   public function update(Request $request, $id)
    {
        if ($request->isMethod('get')) {
            $locationCosts = LocationCost::where('package_id', $id)->get();
            return view('admin.PackageLocation.create', compact('locationCosts', 'id'));
        }

        $validated = $request->validate([
            'locations.*' => 'required|string|max:255',
            'costs.*' => 'required|numeric|min:0',
        ]);

        if (count($request->locations) !== count(array_unique($request->locations))) {
            return redirect()->back()->withErrors(['locations' => 'Duplicate locations are not allowed.'])->withInput();
        }

        \DB::transaction(function () use ($request, $id) {
            $existingEntries = LocationCost::where('package_id', $id)->get()->keyBy('location');

            $processedLocations = [];

            foreach ($request->locations as $index => $location) {
                $cost = $request->costs[$index];
                $processedLocations[] = $location;

                if ($existingEntries->has($location)) {
                    $existing = $existingEntries[$location];
                    $existing->update(['cost' => $cost]);
                } else {
                    LocationCost::create([
                        'package_id' => $id,
                        'location' => $location,
                        'cost' => $cost,
                    ]);
                }
            }

            LocationCost::where('package_id', $id)
                ->whereNotIn('location', $processedLocations)
                ->delete();
        });

        return redirect()->back()->with('message', 'Location & cost updated successfully.');
    }


}
