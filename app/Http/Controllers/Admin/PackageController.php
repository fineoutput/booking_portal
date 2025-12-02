<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackageBooking;
use App\Models\City;
use App\Models\TransferPackageOrder;
use App\Models\RemarkPackageOrder;
use App\Models\State;
use App\Models\HotelPrefrence;
use App\Models\UpgradeRequest;
use App\Models\Tourist;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\adminmodel\Team;
use App\Models\Agent;
use App\Models\Wallet;
use App\Models\WalletTransactions;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{

    function customer(Request $request ,$id){

        $data['tourist'] = Tourist::where('booking_id', $id)->where('type','package')->get();

       return view('admin.package.customer', $data);
    }

    function transfercreate(Request $request,$id) {
        if($request->method()=='POST'){
            $validated = $request->validate([
                'caller_id' => 'required',
            ]);

            $agentCall = new TransferPackageOrder();
            $agentCall->order_id = $id;
            $agentCall->caller_id = $request->caller_id;
            $agentCall->save();  

            return redirect()->route('acceptpackagebooking')->with('success', 'Order Transfer successfully!');
        }
        $data['states'] = State::all();
        $data['agentCalls'] = PackageBooking::where('id',$id)->first();
        // $data['agentCalls'] = AgentCalls::whereNotIn('id', TransferAgentCalls::pluck('agentcalls_id'))->get();
        $data['team'] = Team::where('power',4)->get();
        return view('admin/package/transfercreate',$data);
    }


    function remarkcreate(Request $request,$id) {
        if($request->method()=='POST'){
            $validated = $request->validate([
                'remark' => 'required',
                // 'agentcalls_id' => 'required',
            ]);

            $agentCall = new RemarkPackageOrder();
            $agentCall->order_id = $id;
            $agentCall->remark = $request->remark;
            $agentCall->caller_id = Auth::id();
            $agentCall->save();  

            return redirect()->back()->with('success', 'Remark add successfully!')->with('javascript', 'window.history.go(-2);');

        }
        $data['states'] = State::all();
        $data['agentCalls'] = PackageBooking::where('id',$id)->first();
        // $data['agentCalls'] = AgentCalls::whereNotIn('id', TransferAgentCalls::pluck('agentcalls_id'))->get();
        $data['team'] = Team::where('power',4)->get();
        return view('admin/package/remarkcreate',$data);
    }

    public function viewremark(Request $request,$id)
    {
        $agentCalls = RemarkPackageOrder::where('order_id',$id)->orderBy('id','DESC')->get();
        return view('admin.package.viewremark', compact('agentCalls'));
    }

    function index() {
        $data['package'] = Package::orderBy('id','DESC')->get();
        return view('admin/package/index',$data);
    }

    function pandingindex() {
        $user = Auth::user();
        if($user->power == 4){
        $data['order_id'] = TransferPackageOrder::where('caller_id', $user->id)->pluck('order_id');

        $data['package'] = PackageBooking::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',0)->get();

        }else{
            $data['package'] = PackageBooking::orderBy('id','DESC')->where('status',0)->get();
        }

        return view('admin/package/pandingindex',$data);
    }

    function completeorders() {
        $user = Auth::user();
        if($user->power == 4){
        $data['order_id'] = TransferPackageOrder::where('caller_id', $user->id)->pluck('order_id');

        $data['package'] = PackageBooking::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',1)->get();

        }else{
            $data['package'] = PackageBooking::orderBy('id','DESC')->where('status',1)->get();
        }
        return view('admin/package/pandingindex',$data);
    }

    function processorders() {
        $user = Auth::user();
        if($user->power == 4){
        $data['order_id'] = TransferPackageOrder::where('caller_id', $user->id)->pluck('order_id');

        $data['package'] = PackageBooking::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',4)->get();

        }else{
            $data['package'] = PackageBooking::orderBy('id','DESC')->where('status',4)->get();
        }
        return view('admin/package/pandingindex',$data);
    }

    function rejectorders() {
        $user = Auth::user();
        if($user->power == 4){
        $data['order_id'] = TransferPackageOrder::where('caller_id', $user->id)->pluck('order_id');

        $data['package'] = PackageBooking::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',2)->get();

        }else{
            $data['package'] = PackageBooking::orderBy('id','DESC')->where('status',2)->get();
        }
        return view('admin/package/pandingindex',$data);
    }

    function acceptorders() {
       $user = Auth::user();
        if($user->power == 4){
        $data['order_id'] = TransferPackageOrder::where('caller_id', $user->id)->pluck('order_id');

        $data['package'] = PackageBooking::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',3)->get();

        }else{
            $data['package'] = PackageBooking::orderBy('id','DESC')->where('status',3)->get();
        }
        return view('admin/package/pandingindex',$data);
    }

    function upgradeorders($id) {
            $data['UpgradeRequest'] = UpgradeRequest::orderBy('id','DESC')->where('type','package')->where('booking_id',$id)->get();
            return view('admin/package/upgrade',$data);
    }
    
    function hotelprefrenceorders($id) {
            $data['UpgradeRequest'] = HotelPrefrence::orderBy('id','DESC')->where('booking_id',$id)->get();
            return view('admin/package/hotelprefrence',$data);
    }


    // public function updateStatus($id)
    // {
    //     $vehicle = PackageBooking::findOrFail($id);
    //     $vehicle->status = ($vehicle->status == 0) ? 1 : 0;
    //     $vehicle->save();

    //     return redirect()->back()->with('success', 'Package Booking status updated successfully!');
    // }

    public function updateStatus($id)
    {
        $vehicle = PackageBooking::findOrFail($id);

        $action = request()->input('status_action');

        if ($action == 'complete') {

            $vehicle->status = 1;

        } elseif ($action == 'cancel') {

              if($vehicle->status == 3 || $vehicle->status == 4){
            $user = Agent::where('id', $vehicle->user_id)->first();
           $wallet = Wallet::where('user_id', $vehicle->user_id)->first();

            $addAmount = floatval($vehicle->fetched_price);

            $newBalance = $wallet->balance + $addAmount;

            $wallet->balance = $newBalance;
            $wallet->save();
              $transaction = WalletTransactions::create([
                    'user_id'          => $user->id,
                    'transaction_type' => 'credit',
                    'amount'           => $vehicle->fetched_price,
                    'note'             => 'The refund for your Package booking cancellation has been processed. #'.$vehicle->id,
                    'status'           => 1,
                ]);
            }

            $vehicle->status = 2;
        } elseif ($action == 'accept') {

             $user = Agent::where('id', $vehicle->user_id)->first();
        $wallet = Wallet::where('user_id', $vehicle->user_id)->first();

        if (!$wallet) {
            return redirect()->back()->with('error', 'Wallet not found!');
        }

        $deductAmount = floatval($vehicle->fetched_price); 

        $newBalance = $wallet->balance - $deductAmount;

        if ($newBalance < -$user->negative_limit_amount) {
            return redirect()->back()->with('error', 'Wallet limit exceeded! You cannot go beyond negative limit of ₹' . $user->negative_limit_amount);
        }

        $wallet->balance = $newBalance;
        $wallet->save();

        $transaction = WalletTransactions::create([
                    'user_id'          => $user->id,
                    'transaction_type' => 'debit',
                    'amount'           => $vehicle->fetched_price,
                    'note'             => 'The amount for your Package booking has been deducted. #'.$vehicle->id,
                    'status'           => 1,
                ]);

            $vehicle->status = 3;
        } elseif ($action == 'process') {

            $vehicle->status = 4;

        } else {

            return redirect()->back()->with('error', 'Invalid status update action.');
            
        }
    
        $vehicle->save();
    
        return redirect()->back()->with('success', 'Package Booking status updated successfully!');
    }

    public function upgradeupdateStatus($id)
    {
        $vehicle = UpgradeRequest::findOrFail($id);

        $action = request()->input('status_action');

      if ($action == 'cancel') {
            $vehicle->status = 1;
        } elseif ($action == 'accept') {

            $vehicle->status = 2;
        } elseif ($action == 'process') {

            $vehicle->status = 2;

        } else {

            return redirect()->back()->with('error', 'Invalid status update action.');
            
        }
    
        $vehicle->save();
    
        return redirect()->back()->with('success', 'status updated successfully!');
    }
    


    // public function getCitiesByState(Request $request)
    // {
    //     $stateIds = $request->input('state_ids', []);
        
    //     if (empty($stateIds)) {
    //         return response()->json(['cities' => []]);
    //     }

    //     $cities = City::whereIn('state_id', $stateIds)->get(['id', 'state_id', 'city_name']);
        
    //     $groupedCities = [];
    //     foreach ($cities as $city) {
    //         $groupedCities[$city->state_id][] = $city;
    //     }

    //     return response()->json(['cities' => $groupedCities]);
    // }

    public function getCitiesByState(Request $request)
    {
       $stateIds = $request->query('state_ids', []);
        $cities = [];

        if (!empty($stateIds)) {
            foreach ($stateIds as $stateId) {
                $cities[$stateId] = City::where('state_id', $stateId)
                    ->select('id', 'city_name')
                    ->get()
                    ->toArray();
            }
        }

        return response()->json(['cities' => $cities]);

    }

    function create(Request $request) {
        if($request->method()=='POST'){
            // return $request->state_id;
               // Validate the incoming request
        $validated = $request->validate([
            'city_id' => 'required',
        ]);


        if ($request->hasFile('image')) {
            $imagePaths = [];
            $destinationPath = public_path('packages/images');  
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);  
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
// return $request->city_id;
        $package = new Package();
        $package->package_name = $request->package_name;
        // $package->service_charge = $request->service_charge;
        $package->state_id = implode(',', $request->state_id);
        $package->city_id = implode(',', $request->city_id);
        $package->image = $imagePaths ? json_encode($imagePaths) : null; 
        $package->video = $videoPaths ? json_encode($videoPaths) : null; 
        $package->text_description = $request->text_description;
        $package->title_description = $request->title_description;
        $package->pickup_location = $request->pickup_location;
        $package->night_count = $request->night_count;
        $package->pdf = $pdfPath;
        $package->text_description_2 = $request->text_description_2;

        $package->save();

        return redirect()->route('package')->with('success', 'Package added successfully.');
    
        }

        $data['states'] = State::all();

        return view('admin/package/create',$data);
    }


    public function showFront($id, Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'show_front_value' => 'required|in:0,1',  // Ensure it's either 0 or 1
        ]);
    
        // Find the package by ID
        $pkg = Package::findOrFail($id);
    
        // Update the 'show_front' field based on the request
        $pkg->show_front = $request->input('show_front_value'); // Store 0 or 1
        $pkg->save(); // Save the updated value to the database
    
        // Return a JSON response (success message)
        return response()->json([
            'success' => true,
            'message' => 'Package visibility updated successfully!',
            'show_front_value' => $pkg->show_front // Return updated show_front value
        ]);
    }

    public function holidaypackage($id, Request $request)
    {
        $validated = $request->validate([
            'holidaypackagevalue' => 'required|in:0,1',
        ]);

        $pkg = Package::findOrFail($id);
        $pkg->holidaypackage = $request->input('holidaypackagevalue');
        $pkg->save();

        return response()->json([
            'success' => true,
            'message' => 'Holiday package visibility updated successfully!',
            'holidaypackagevalue' => $pkg->holidaypackage
        ]);
    }

    public function travelpackage($id, Request $request)
    {
        $validated = $request->validate([
            'travelpackage' => 'required|in:0,1',
        ]);

        $pkg = Package::findOrFail($id);
        $pkg->travelpackage = $request->input('travelpackage');
        $pkg->save();

        return response()->json([
            'success' => true,
            'message' => 'Travel package visibility updated successfully!',
            'travelpackage' => $pkg->travelpackage
        ]);
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
            $data['package'] = Package::with('state')->findOrFail($id);
            $data['states'] = State::all();

            // Pass the package data to the edit view
            return view('admin/package/edit',$data);
        }



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

    $package = Package::findOrFail($id);

    if ($request->has('state_id') && !empty($request->state_id)) {
        $stateIds = $request->state_id;
        $package->state_id = implode(',', $stateIds);
    }

    $cityIds = $request->has('city_id') ? $request->city_id : explode(',', $package->city_id);
    $package->city_id = implode(',', $cityIds);

    $package->package_name = $request->package_name;
    // $package->service_charge = $request->service_charge;
    $package->text_description = $request->text_description;
    $package->night_count = $request->night_count;
    $package->text_description_2 = $request->text_description_2;
    $package->title_description = $request->title_description;
    $package->pickup_location = $request->pickup_location;


    if ($request->hasFile('image')) {
        $existingImages = json_decode($package->image, true) ?? [];
        $newImages = [];
        $destinationPath = public_path('packages/images');  
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);  
        }
    
        foreach ($request->file('image') as $image) {
        
            $filename = time() . '_' . $image->getClientOriginalName();

            $image->move($destinationPath, $filename);

            $newImages[] = 'packages/images/' . $filename;
        }

        $package->image = json_encode(array_merge($existingImages, $newImages));  
    }

    if ($request->has('deleted_images')) {
        $deletedImages = explode(',', $request->deleted_images); 
        $this->deleteFiles($deletedImages);  
   
        $existingImages = json_decode($package->image, true);
        $updatedImages = array_diff($existingImages, $deletedImages); 
        $package->image = json_encode($updatedImages);
    }
    
   
    if ($request->has('deleted_videos')) {
        $deletedVideos = explode(',', $request->deleted_videos);  
        $existingVideos = json_decode($package->video, true);
    
        // $updatedVideos = array_filter($existingVideos, function ($video) use ($deletedVideos) {
        //     return !in_array($video, $deletedVideos); 
        // });
        $updatedVideos = is_array($existingVideos) 
    ? array_filter($existingVideos, function ($video) use ($deletedVideos) {
        return !in_array($video, $deletedVideos);
    }) 
    : [];

        foreach ($deletedVideos as $video) {
            $videoPath = public_path($video); 
            if (file_exists($videoPath) && is_file($videoPath)) {
                unlink($videoPath); 
            }
        }

        $package->video = json_encode(array_values($updatedVideos));
    }
    
    if ($request->hasFile('video')) {
        $videoPaths = [];
        $destinationPath = public_path('packages/videos');  

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true); 
        }
    
        foreach ($request->file('video') as $video) {

            $filename = time() . '_' . $video->getClientOriginalName();

            $video->move($destinationPath, $filename);

            $videoPaths[] = 'packages/videos/' . $filename;
        }

        $existingVideos = json_decode($package->video, true) ?? [];
        $package->video = json_encode(array_merge($existingVideos, $videoPaths));
    }

    if ($request->hasFile('pdf')) {
        if ($package->pdf) {
            $oldPdfPath = public_path('packages/pdf/' . $package->pdf); 
            if (file_exists($oldPdfPath)) {
                unlink($oldPdfPath);  
            }
        }
    
        $destinationPath = public_path('packages/pdf');  
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);  
        }

        $filename = time() . '_' . $request->file('pdf')->getClientOriginalName();

        $request->file('pdf')->move($destinationPath, $filename);

        $pdfPath = 'packages/pdf/' . $filename;
    
        $package->pdf = $pdfPath;
    }

    $package->save();

    return redirect()->route('package')->with('success', 'Package updated successfully.');
}



protected function deleteFiles($files)
{
    
    $basePath = public_path();

    if (is_array($files)) {
 
        foreach ($files as $file) {
            $filePath = $basePath . '/' . $file; 

            if (file_exists($filePath) && !is_dir($filePath)) {
                unlink($filePath);  
            }
        }
    } elseif ($files) {

        $filePath = $basePath . '/' . $files; 

        if (file_exists($filePath) && !is_dir($filePath)) {
            unlink($filePath);  
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
