<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\City;
use App\Models\State;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PackageController extends Controller
{
    function index() {
        $data['package'] = Package::orderBy('id','DESC')->get();
        return view('admin/package/index',$data);
    }

    public function getCitiesByState($stateId)
    {
    $cities = City::where('state_id', $stateId)->get(['id', 'city_name']);
    return response()->json(['cities' => $cities]);
    }


    function create(Request $request) {
        if($request->method()=='POST'){
               // Validate the incoming request
        // $validated = $request->validate([
        //     'package_name' => 'required',
        //     'state_id' => 'required',
        //     'city_id' => 'required',
        //     'image' => 'required', 
        //     'video' => 'required',
        //     'text_description' => 'required',
        //     'text_description_2' => 'required',
        // ]);
        // return 'hello';

        if ($request->hasFile('image')) {
            $imagePaths = [];
            foreach ($request->file('image') as $image) {
                $imagePaths[] = $image->store('packages/images', 'public');
            }
        } else {
            $imagePaths = null;
        }

        if ($request->hasFile('video')) {
            $videoPaths = [];
            foreach ($request->file('video') as $video) {
                $videoPaths[] = $video->store('packages/videos', 'public'); 
            }
        } else {
            $videoPaths = null;
        }

        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('pdf', 'public');
        }

        $package = new Package();
        $package->package_name = $request->package_name;
        $package->state_id = $request->state_id;
        $package->city_id = $request->city_id;
        $package->image = $imagePaths ? json_encode($imagePaths) : null; 
        $package->video = $videoPaths ? json_encode($videoPaths) : null; 
        $package->text_description = $request->text_description;
        $package->pdf = $pdfPath;
        $package->text_description_2 = $request->text_description_2;

        $package->save();

        return redirect()->route('package')->with('success', 'Package added successfully.');
    
        }

        $data['states'] = State::all();

        return view('admin/package/create',$data);
    }

    public function destroy($id)
    {
        $package = Package::findOrFail($id);

        $this->deleteFiles($package->image); 
        $this->deleteFiles($package->video); 

        $package->delete();
        return redirect()->route('package')->with('success', 'Package deleted successfully.');
    }


    protected function deleteFiles($filePaths)
    {
        if ($filePaths) {
            $filePaths = is_array($filePaths) ? $filePaths : json_decode($filePaths);

            foreach ($filePaths as $filePath) {
                if (Storage::exists('public/' . $filePath)) {
                    Storage::delete('public/' . $filePath);
                }
            }
        }}

        public function edit($id)
        {
            // Retrieve the package by its ID
            $data['package'] = Package::findOrFail($id);
            $data['states'] = State::all();

            // Pass the package data to the edit view
            return view('admin/package/edit',$data);
        }


        public function update(Request $request, $id)
        {
            // Validate the incoming request
            $validated = $request->validate([
                'package_name' => 'required',
                'state_id' => 'required',
                // 'city_id' => 'required',
                'image' => 'nullable|array', // Images can be null or an array
                'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate individual images
                'video' => 'nullable|array', // Videos can be null or an array
                'video.*' => 'nullable|mimes:mp4,mkv,avi,webm|max:50000', // Validate individual videos
                'text_description' => 'required',
                'text_description_2' => 'required',
            ]);
        
            // Find the existing package by ID
            $package = Package::findOrFail($id);
        
            // Handle image upload and update
            if ($request->hasFile('image')) {
                // Delete the old images from storage (if any)
                $this->deleteFiles($package->image);
        
                // Handle new image uploads
                $imagePaths = [];
                foreach ($request->file('image') as $image) {
                    $imagePaths[] = $image->store('packages/images', 'public');
                }
                $package->image = json_encode($imagePaths);  // Store the new image paths
            }
        
            // Remove the images that the user deleted
            if ($request->has('deleted_images')) {
                $deletedImages = explode(',', $request->deleted_images);  // Get the deleted image paths from the form
                $this->deleteFiles($deletedImages);  // Delete these images from storage
        
                // Update the package images after deletion
                $existingImages = json_decode($package->image, true);
                $updatedImages = array_diff($existingImages, $deletedImages);  // Remove the deleted images from the array
                $package->image = json_encode($updatedImages);  // Store the updated image paths
            }
        
            // Handle video upload and update
            if ($request->hasFile('video')) {
                $videoPaths = [];
                foreach ($request->file('video') as $video) {
                    $videoPaths[] = $video->store('packages/videos', 'public');
                }
                $package->video = json_encode($videoPaths);  // Store the new video paths
            }
        
            if ($request->hasFile('pdf')) {
                if ($package->pdf) {
                    Storage::disk('public')->delete($package->pdf);
                }
                $pdfPath = $request->file('pdf')->store('pdf', 'public');
                $package->pdf = $pdfPath;
            }
        

            // Update the package fields
            $package->package_name = $request->package_name;
            $package->state_id = $request->state_id;
            $package->city_id = $request->city_id ?? $package->city_id ;
            $package->text_description = $request->text_description;
            $package->text_description_2 = $request->text_description_2;
        
            // Save the updated package record to the database
            $package->save();
        
            return redirect()->route('package')->with('success', 'Package updated successfully.');
        }

// Helper function to delete files from storage



}
