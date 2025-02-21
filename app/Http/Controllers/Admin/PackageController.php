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

    public function getCitiesByState(Request $request)
    {
        $stateIds = $request->input('state_ids', []);
        
        if (empty($stateIds)) {
            return response()->json(['cities' => []]);
        }

        $cities = City::whereIn('state_id', $stateIds)->get(['id', 'state_id', 'city_name']);
        
        $groupedCities = [];
        foreach ($cities as $city) {
            $groupedCities[$city->state_id][] = $city;
        }

        return response()->json(['cities' => $groupedCities]);
    }

    function create(Request $request) {
        if($request->method()=='POST'){
            // return $request->state_id;
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
        $package->state_id = implode(',', $request->state_id);
        $package->city_id = implode(',', $request->city_id);
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
    // $request->validate([
    //     // 'package_name' => 'required|string|max:255',
    //     // 'state_id' => 'required',
    //     // 'city_id' => 'nullable',
    //     // 'image' => 'nullable|array', // Images can be null or an array
    //     // 'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
    //     // 'video' => 'nullable|array', // Videos can be null or an array
    //     // 'video.*' => 'nullable|mimes:mp4,mkv,avi,webm',
    //     // 'text_description' => 'required|string',
    //     // 'text_description_2' => 'required|string',
    //     // 'pdf' => 'nullable|mimes:pdf|max:5000',
    // ]);

    // Find the existing package by ID
    $package = Package::findOrFail($id);

    // Update the basic fields
    
    $package->package_name = $request->package_name;
    $stateIds = $request->state_id;
    $cityIds = $request->city_id ?? $package->city_id;
    $package->state_id = implode(',', $stateIds);
    $package->city_id = implode(',', $cityIds);
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
    // if ($request->hasFile('video')) {
    //     if ($package->video) {
    //         $oldVideoPath = public_path('packages/videos/' . $package->video);  // Get the old video path
    //         if (file_exists($oldVideoPath)) {
    //             unlink($oldVideoPath);  // Delete the old video if it exists
    //         }
    //     }
    
    //     $videoPaths = [];
    //     $destinationPath = public_path('packages/videos');  // Define the destination directory for videos
    
    //     // Ensure the destination directory exists
    //     if (!file_exists($destinationPath)) {
    //         mkdir($destinationPath, 0777, true);  // Create the directory with full permissions
    //     }
    
    //     foreach ($request->file('video') as $video) {
    //         // Generate a unique filename (you can modify this as needed)
    //         $filename = time() . '_' . $video->getClientOriginalName();
            
    //         // Move the video to the public directory
    //         $video->move($destinationPath, $filename);
            
    //         // Add the relative path of the video to the array
    //         $videoPaths[] = 'packages/videos/' . $filename;
    //     }
    
    //     $package->video = json_encode($videoPaths);  // Store the new video paths
    // }
    
    if ($request->has('deleted_videos')) {
        $deletedVideos = explode(',', $request->deleted_videos);  // Get deleted video paths
    
        // Decode the existing video paths from the database
        $existingVideos = json_decode($package->video, true);
    
        // Filter out the deleted videos from the existing ones
        $updatedVideos = array_filter($existingVideos, function ($video) use ($deletedVideos) {
            return !in_array($video, $deletedVideos);  // Compare the full path, not just the basename
        });
    
        // Delete the video files from the server
        foreach ($deletedVideos as $video) {
            $videoPath = public_path($video);  // Use the full path from the database
            if (file_exists($videoPath) && is_file($videoPath)) {
                unlink($videoPath);  // Delete the video file from the server
            }
        }
    
        // Update the package's video paths in the database
        $package->video = json_encode(array_values($updatedVideos));
    }
    
    // Handle new video uploads (if any)
    if ($request->hasFile('video')) {
        $videoPaths = [];
        $destinationPath = public_path('packages/videos');  // Define the destination directory
    
        // Ensure the destination directory exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);  // Create the directory if it doesn't exist
        }
    
        foreach ($request->file('video') as $video) {
            // Generate a unique filename
            $filename = time() . '_' . $video->getClientOriginalName();
    
            // Move the video to the destination directory
            $video->move($destinationPath, $filename);
    
            // Add the video path to the array
            $videoPaths[] = 'packages/videos/' . $filename;
        }
    
        // Merge the new videos with the existing ones
        $existingVideos = json_decode($package->video, true) ?? [];
        $package->video = json_encode(array_merge($existingVideos, $videoPaths));
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
