<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotels;
use App\Models\Package;
use App\Models\State;
use App\Models\City;
use App\Models\HotelsRoom;
use Illuminate\Support\Facades\Storage;

class HotelsRoomController extends Controller
{
    function index($id) {
        $data['hotels'] = Hotels::where('id',$id)->first();
        $data['hotels_room'] = HotelsRoom::where('hotel_id',$id)->orderBy('id','DESC')->get();
        return view('admin/hotels_rooms/index',$data);
    }
    
    function create($id) {
        $data['hotels'] = Hotels::where('id',$id)->first();
        $data['hotels_room'] = HotelsRoom::orderBy('id','DESC')->get();
        return view('admin/hotels_rooms/create',$data);
    }


   public function store(Request $request,$id)
    {

        $hotel = Hotels::where('id',$id)->first();

        $request->validate([
            'title' => 'required',
        ]);

        $imagePaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $destination = public_path('uploads/hotels_rooms');

                if (!file_exists($destination)) {
                    mkdir($destination, 0777, true);
                }

                $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move($destination, $fileName);
                $imagePaths[] = 'uploads/hotels_rooms/' . $fileName;
            }
        }

        HotelsRoom::create([
            'title' => $request->title,
            'description' => $request->description,
            'hotel_id' => $hotel->id,
            'images' => json_encode($imagePaths),
            'meal_plan' => is_array($request->meal_plan) ? implode(',', $request->meal_plan) : null,
            'nearby' => is_array($request->nearby) ? implode(',', $request->nearby) : null,
            'locality' => is_array($request->locality) ? implode(',', $request->locality) : null,
            'chains' => is_array($request->chains) ? implode(',', $request->chains) : null,
            'hotel_amenities' => is_array($request->hotel_amenities) ? implode(',', $request->hotel_amenities) : null,
            'room_amenities' => is_array($request->room_amenities) ? implode(',', $request->room_amenities) : null,
            'house_rules' => is_array($request->house_rules) ? implode(',', $request->house_rules) : null,
        ]);

        return redirect()->route('hotels_room',$hotel->id,)->with('success', 'Room added successfully.');
    }

    public function edit($id)
    {
        $data['hotel_room'] = HotelsRoom::findOrFail($id);
        $data['hotel'] = Hotels::where('id',$data['hotel_room']->hotel_id)->first();
        $data['packages']  = Package::all();
        $data['states'] = State::all();

        return view('admin/hotels_rooms/edit',$data);
    }



  public function update(Request $request, $id)
    {
        $room = HotelsRoom::findOrFail($id);

        // Handle remove images
        $existingImages = json_decode($room->images, true) ?? [];
        $removeImages = $request->input('remove_images', []);
        $updatedImages = [];

        foreach ($existingImages as $img) {
            if (in_array($img, $removeImages)) {
                if (file_exists(public_path($img))) {
                    unlink(public_path($img)); // Delete from server
                }
            } else {
                $updatedImages[] = $img; // Keep image
            }
        }

        // Handle new uploaded images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $destinationPath = public_path('hotels/images');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move($destinationPath, $filename);

                $updatedImages[] = 'hotels/images/' . $filename;
            }
        }

        // Update room
        $room->title = $request->title;
        $room->description = $request->description;
        $room->hotel_id = $request->hotel_id ?? $room->hotel_id;

        $room->meal_plan = !empty($request->meal_plan) ? implode(',', $request->meal_plan) : null;
        $room->nearby = !empty($request->nearby) ? implode(',', $request->nearby) : null;
        $room->locality = !empty($request->locality) ? implode(',', $request->locality) : null;
        $room->chains = !empty($request->chains) ? implode(',', $request->chains) : null;
        $room->hotel_amenities = !empty($request->hotel_amenities) ? implode(',', $request->hotel_amenities) : null;
        $room->room_amenities = !empty($request->room_amenities) ? implode(',', $request->room_amenities) : null;
        $room->house_rules = !empty($request->house_rules) ? implode(',', $request->house_rules) : null;

        $room->images = count($updatedImages) ? json_encode($updatedImages) : null;

        $room->save();

        return redirect()->route('hotels_room',$room->hotel_id,)->with('success', 'Room updated successfully.');
    }



    public function delete($id)
    {
        $room = HotelsRoom::findOrFail($id);

        $images = json_decode($room->images, true) ?? [];

        foreach ($images as $img) {
            if (file_exists(public_path($img))) {
                unlink(public_path($img));
            }
        }

        $room->delete();

        return redirect()->back()->with('success', 'Room deleted successfully.');
    }

}
