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

        // if ($request->hasFile('image')) {
        //     $imagePaths = [];
        //     foreach ($request->file('image') as $image) {
        //         $imagePaths[] = $image->store('packages/images', 'public');
        //     }
        // } else {
        //     $imagePaths = null;
        // }

        // if ($request->hasFile('video')) {
        //     $videoPaths = [];
        //     foreach ($request->file('video') as $video) {
        //         $videoPaths[] = $video->store('packages/videos', 'public'); 
        //     }
        // } else {
        //     $videoPaths = null;
        // }

        // if ($request->hasFile('pdf')) {
        //     $pdfPath = $request->file('pdf')->store('pdf', 'public');
        // }


        if ($request->hasFile('image')) {
            $imagePaths = [];
            $destinationPath = public_path('packages/images');  // Define the destination directory for images
        
            // Ensure the destination directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);  // Create the directory with full permissions
            }
        
            foreach ($request->file('image') as $image) {
                // Generate a unique filename (you can modify this as needed)
                $filename = time() . '_' . $image->getClientOriginalName();
                
                // Move the image to the public directory
                $image->move($destinationPath, $filename);
                
                // Add the relative path of the image to the array
                $imagePaths[] = 'packages/images/' . $filename;
            }
        } else {
            $imagePaths = null;
        }
        
        if ($request->hasFile('video')) {
            $videoPaths = [];
            $destinationPath = public_path('packages/videos');  // Define the destination directory for videos
        
            // Ensure the destination directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);  // Create the directory with full permissions
            }
        
            foreach ($request->file('video') as $video) {
                // Generate a unique filename (you can modify this as needed)
                $filename = time() . '_' . $video->getClientOriginalName();
                
                // Move the video to the public directory
                $video->move($destinationPath, $filename);
                
                // Add the relative path of the video to the array
                $videoPaths[] = 'packages/videos/' . $filename;
            }
        } else {
            $videoPaths = null;
        }
        
        if ($request->hasFile('pdf')) {
            $destinationPath = public_path('packages/pdf');  // Define the destination directory for PDFs
        
            // Ensure the destination directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);  // Create the directory with full permissions
            }
        
            // Generate a unique filename (you can modify this as needed)
            $filename = time() . '_' . $request->file('pdf')->getClientOriginalName();
            
            // Move the PDF to the public directory
            $request->file('pdf')->move($destinationPath, $filename);
            
            // Add the relative path of the PDF
            $pdfPath = 'packages/pdf/' . $filename;
        } else {
            $pdfPath = null;
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


    

        public function edit($id)
        {
            // Retrieve the package by its ID
            $data['package'] = Package::findOrFail($id);
            $data['states'] = State::all();

            // Pass the package data to the edit view
            return view('admin/package/edit',$data);
        }


        // public function update(Request $request, $id)
        // {
        //     $validated = $request->validate([
        //         'package_name' => 'required',
        //         'state_id' => 'required',
        //         // 'city_id' => 'required',
        //         'image' => 'nullable|array', // Images can be null or an array
        //         'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //         'video' => 'nullable|array', // Videos can be null or an array
        //         'video.*' => 'nullable|mimes:mp4,mkv,avi,webm|max:50000',
        //         'text_description' => 'required',
        //         'text_description_2' => 'required',
        //     ]);
        //     $package = Package::findOrFail($id);
        //     if ($request->hasFile('image')) {
        //         $this->deleteFiles($package->image);
        //         $imagePaths = [];
        //         foreach ($request->file('image') as $image) {
        //             $imagePaths[] = $image->store('packages/images', 'public');
        //         }
        //         $package->image = json_encode($imagePaths);
        //     }
        //     if ($request->has('deleted_images')) {
        //         $deletedImages = explode(',', $request->deleted_images); 
        //         $this->deleteFiles($deletedImages);
        //         $existingImages = json_decode($package->image, true);
        //         $updatedImages = array_diff($existingImages, $deletedImages); 
        //         $package->image = json_encode($updatedImages);  
        //     }

        //     if ($request->hasFile('video')) {
        //         $videoPaths = [];
        //         foreach ($request->file('video') as $video) {
        //             $videoPaths[] = $video->store('packages/videos', 'public');
        //         }
        //         $package->video = json_encode($videoPaths); 
        //     }
        
        //     if ($request->hasFile('pdf')) {
        //         if ($package->pdf) {
        //             Storage::disk('public')->delete($package->pdf);
        //         }
        //         $pdfPath = $request->file('pdf')->store('pdf', 'public');
        //         $package->pdf = $pdfPath;
        //     }

        //     $package->package_name = $request->package_name;
        //     $package->state_id = $request->state_id;
        //     $package->city_id = $request->city_id ?? $package->city_id ;
        //     $package->text_description = $request->text_description;
        //     $package->text_description_2 = $request->text_description_2;
        //     $package->save();
        
        //     return redirect()->route('package')->with('success', 'Package updated successfully.');
        // }


        public function update(Request $request, $id)
{
    // Validate the incoming request
    $request->validate([
        'package_name' => 'required|string|max:255',
        'state_id' => 'required',
        'city_id' => 'nullable',
        'image' => 'nullable|array', // Images can be null or an array
        'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'video' => 'nullable|array', // Videos can be null or an array
        'video.*' => 'nullable|mimes:mp4,mkv,avi,webm|max:50000',
        'text_description' => 'required|string',
        'text_description_2' => 'required|string',
        'pdf' => 'nullable|mimes:pdf|max:5000',
    ]);

    // Find the existing package by ID
    $package = Package::findOrFail($id);

    // Update the basic fields
    $package->package_name = $request->package_name;
    $package->state_id = $request->state_id;
    $package->city_id = $request->city_id ?? $package->city_id;  // Use current city_id if not provided
    $package->text_description = $request->text_description;
    $package->text_description_2 = $request->text_description_2;

    // Handle image uploads and removal of old images
    // if ($request->hasFile('image')) {
    //     $existingImages = json_decode($package->image, true) ?? [];
    //     $newImages = [];
    //     foreach ($request->file('image') as $image) {
    //         $newImages[] = $image->store('packages/images', 'public');
    //     }
    //     $package->image = json_encode(array_merge($existingImages, $newImages));  // Merge new images with the existing ones
    // }

    // // Handle the deletion of images
    // if ($request->has('deleted_images')) {
    //     $deletedImages = explode(',', $request->deleted_images);  // Get deleted image paths from the form
    //     $this->deleteFiles($deletedImages);  // Delete the specified images

    //     // Update the package images after removal
    //     $existingImages = json_decode($package->image, true);
    //     $updatedImages = array_diff($existingImages, $deletedImages);  // Remove the deleted images
    //     $package->image = json_encode($updatedImages);  // Update image paths
    // }

    // // Handle video upload and update
    // if ($request->hasFile('video')) {
    //     if ($package->video) {
    //         Storage::delete('public/' . $package->video);  // Delete the old video if any
    //     }
    //     $videoPaths = [];
    //     foreach ($request->file('video') as $video) {
    //         $videoPaths[] = $video->store('packages/videos', 'public');
    //     }
    //     $package->video = json_encode($videoPaths);  // Store the new video paths
    // }

    // // Handle PDF upload and update
    // if ($request->hasFile('pdf')) {
    //     if ($package->pdf) {
    //         Storage::disk('public')->delete($package->pdf);  // Delete the old PDF if any
    //     }
    //     $pdfPath = $request->file('pdf')->store('packages/pdf', 'public');
    //     $package->pdf = $pdfPath;  // Store the new PDF path
    // }

    if ($request->hasFile('image')) {
        $existingImages = json_decode($package->image, true) ?? [];
        $newImages = [];
        $destinationPath = public_path('packages/images');  // Define the destination directory for images
    
        // Ensure the destination directory exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);  // Create the directory with full permissions
        }
    
        foreach ($request->file('image') as $image) {
            // Generate a unique filename (you can modify this as needed)
            $filename = time() . '_' . $image->getClientOriginalName();
            
            // Move the image to the public directory
            $image->move($destinationPath, $filename);
            
            // Add the relative path of the image to the array
            $newImages[] = 'packages/images/' . $filename;
        }
    
        // Merge new images with existing ones
        $package->image = json_encode(array_merge($existingImages, $newImages));  // Merge new images with the existing ones
    }
    
    // Handle the deletion of images
    if ($request->has('deleted_images')) {
        $deletedImages = explode(',', $request->deleted_images);  // Get deleted image paths from the form
        $this->deleteFiles($deletedImages);  // Delete the specified images
    
        // Update the package images after removal
        $existingImages = json_decode($package->image, true);
        $updatedImages = array_diff($existingImages, $deletedImages);  // Remove the deleted images
        $package->image = json_encode($updatedImages);  // Update image paths
    }
    
    // Handle video upload and update
    if ($request->hasFile('video')) {
        if ($package->video) {
            $oldVideoPath = public_path('packages/videos/' . $package->video);  // Get the old video path
            if (file_exists($oldVideoPath)) {
                unlink($oldVideoPath);  // Delete the old video if it exists
            }
        }
    
        $videoPaths = [];
        $destinationPath = public_path('packages/videos');  // Define the destination directory for videos
    
        // Ensure the destination directory exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);  // Create the directory with full permissions
        }
    
        foreach ($request->file('video') as $video) {
            // Generate a unique filename (you can modify this as needed)
            $filename = time() . '_' . $video->getClientOriginalName();
            
            // Move the video to the public directory
            $video->move($destinationPath, $filename);
            
            // Add the relative path of the video to the array
            $videoPaths[] = 'packages/videos/' . $filename;
        }
    
        $package->video = json_encode($videoPaths);  // Store the new video paths
    }
    
    // Handle PDF upload and update
    if ($request->hasFile('pdf')) {
        if ($package->pdf) {
            $oldPdfPath = public_path('packages/pdf/' . $package->pdf);  // Get the old PDF path
            if (file_exists($oldPdfPath)) {
                unlink($oldPdfPath);  // Delete the old PDF if it exists
            }
        }
    
        $destinationPath = public_path('packages/pdf');  // Define the destination directory for PDFs
    
        // Ensure the destination directory exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);  // Create the directory with full permissions
        }
    
        // Generate a unique filename (you can modify this as needed)
        $filename = time() . '_' . $request->file('pdf')->getClientOriginalName();
        
        // Move the PDF to the public directory
        $request->file('pdf')->move($destinationPath, $filename);
        
        // Add the relative path of the PDF
        $pdfPath = 'packages/pdf/' . $filename;
    
        $package->pdf = $pdfPath;  // Store the new PDF path
    }
    

    // Save the updated package record to the database
    $package->save();

    // Redirect back with a success message
    return redirect()->route('package')->with('success', 'Package updated successfully.');
}



protected function deleteFiles($files)
{
    // Define the base directory where files are stored (e.g., public/packages/images)
    $basePath = public_path();  // You can adjust this if files are stored in a specific folder within public

    if (is_array($files)) {
        // Iterate through the array of files to delete
        foreach ($files as $file) {
            $filePath = $basePath . '/' . $file;  // Construct the full path of the file

            // Check if the file exists and is not a directory
            if (file_exists($filePath) && !is_dir($filePath)) {
                unlink($filePath);  // Delete the file
            }
        }
    } elseif ($files) {
        // Handle the case where only a single file is passed
        $filePath = $basePath . '/' . $files;  // Construct the full path of the file

        // Check if the file exists and is not a directory
        if (file_exists($filePath) && !is_dir($filePath)) {
            unlink($filePath);  // Delete the file
        }
    }
}


// protected function deleteFiles($files)
// {
//     if (is_array($files)) {
//         foreach ($files as $file) {
//             if (Storage::disk('public')->exists($file)) {
//                 Storage::disk('public')->delete($file);  // Delete each file
//             }
//         }
//     } elseif ($files) {
//         if (Storage::disk('public')->exists($files)) {
//             Storage::disk('public')->delete($files);  // Delete a single file
//         }
//     }
// }
        
        
        // private function deleteFiles(array $files)
        // {
        //     foreach ($files as $file) {
        //         // Check if the file exists before deleting it
        //         if (Storage::disk('public')->exists($file)) {
        //             Storage::disk('public')->delete($file);
        //         }
        //     }
        // }




}
