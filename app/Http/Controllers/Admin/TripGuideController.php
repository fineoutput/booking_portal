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
use App\Models\TripGuide;
use App\Models\State;
use App\Models\TripGuideBook;
use App\Models\City;
use App\Models\TripGuideBook2;
use App\Models\TransferGuideOrder;
use App\Models\RemarkGuideOrder;
use App\adminmodel\Team;
use App\Models\Agent;
use App\Models\Tourist;
use App\Models\Wallet;
use App\Models\WalletTransactions;
use Illuminate\Support\Facades\Auth;


class TripGuideController extends Controller
{

    
    function customer(Request $request ,$id){

        $data['tourist'] = Tourist::where('booking_id', $id)->where('type','Guide')->get();

       return view('admin.tripguide.customer', $data);
    }

    function transfercreate(Request $request,$id) {
        if($request->method()=='POST'){
            $validated = $request->validate([
                'caller_id' => 'required',
            ]);

            $agentCall = new TransferGuideOrder();
            $agentCall->order_id = $id;
            $agentCall->caller_id = $request->caller_id;
            $agentCall->save();  

            return redirect()->route('tripguidebooking')->with('success', 'Order Transfer successfully!');
        }
        $data['states'] = State::all();
        $data['agentCalls'] = TripGuideBook2::where('id',$id)->first();
        // $data['agentCalls'] = AgentCalls::whereNotIn('id', TransferAgentCalls::pluck('agentcalls_id'))->get();
        $data['team'] = Team::where('power',4)->get();
        return view('admin/tripguide/transfercreate',$data);
    }


    function remarkcreate(Request $request,$id) {
        if($request->method()=='POST'){
            $validated = $request->validate([
                'remark' => 'required',
                // 'agentcalls_id' => 'required',
            ]);

            $agentCall = new RemarkGuideOrder();
            $agentCall->order_id = $id;
            $agentCall->remark = $request->remark;
            $agentCall->caller_id = Auth::id();
            $agentCall->save();  

            return redirect()->route('tripguidebooking')->with('success', 'Agent Call Transfer successfully!');
        }
        $data['states'] = State::all();
        $data['agentCalls'] = TripGuideBook2::where('id',$id)->first();
        // $data['agentCalls'] = AgentCalls::whereNotIn('id', TransferAgentCalls::pluck('agentcalls_id'))->get();
        $data['team'] = Team::where('power',4)->get();
        return view('admin/tripguide/remarkcreate',$data);
    }

    public function viewremark(Request $request,$id)
    {
        $agentCalls = RemarkGuideOrder::where('order_id',$id)->orderBy('id','DESC')->get();
        return view('admin.tripguide.viewremark', compact('agentCalls'));
    }


    function index() {
        $data['WildlifeSafari'] = TripGuide::orderBy('id','DESC')->get();
        $data['languages'] = Languages::all();
        return view('admin/tripguide/index',$data);
    }
    
    function tripguidebooking() {
        $user = Auth::user();
        if($user->power == 4){
            $data['order_id'] = TransferGuideOrder::where('caller_id', $user->id)->pluck('order_id');
            $data['TripGuideBook'] = TripGuideBook2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',0)->get();
        }else{
            $data['TripGuideBook'] = TripGuideBook2::orderBy('id','DESC')->where('status',0)->get();
        }
        return view('admin/tripguide/tripguidebooking',$data);
    }

    function completetripguidebooking() {
        $user = Auth::user();
        if($user->power == 4){
            $data['order_id'] = TransferGuideOrder::where('caller_id', $user->id)->pluck('order_id');
            $data['TripGuideBook'] = TripGuideBook2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',1)->get();
        }else{
            $data['TripGuideBook'] = TripGuideBook2::orderBy('id','DESC')->where('status',1)->get();
        }
        return view('admin/tripguide/tripguidebooking',$data);
    }

    function processtripguidebooking() {
        $user = Auth::user();
        if($user->power == 4){
            $data['order_id'] = TransferGuideOrder::where('caller_id', $user->id)->pluck('order_id');
            $data['TripGuideBook'] = TripGuideBook2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',4)->get();
        }else{
            $data['TripGuideBook'] = TripGuideBook2::orderBy('id','DESC')->where('status',4)->get();
        }
        return view('admin/tripguide/tripguidebooking',$data);
    }

    function accepttripguidebooking() {
        $user = Auth::user();
        if($user->power == 4){
            $data['order_id'] = TransferGuideOrder::where('caller_id', $user->id)->pluck('order_id');
            $data['TripGuideBook'] = TripGuideBook2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',3)->get();
        }else{
            $data['TripGuideBook'] = TripGuideBook2::orderBy('id','DESC')->where('status',3)->get();
        }
        return view('admin/tripguide/tripguidebooking',$data);
    }

    function rejecttripguidebooking() {
        $user = Auth::user();
        if($user->power == 4){
            $data['order_id'] = TransferGuideOrder::where('caller_id', $user->id)->pluck('order_id');
            $data['TripGuideBook'] = TripGuideBook2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',2)->get();
        }else{
            $data['TripGuideBook'] = TripGuideBook2::orderBy('id','DESC')->where('status',2)->get();
        }
        return view('admin/tripguide/tripguidebooking',$data);
    }

    // public function updateStatuss($id)
    // {
    //     $vehicle = TripGuideBook::findOrFail($id);
    //     $vehicle->status = ($vehicle->status == 0) ? 1 : 0;
    //     $vehicle->save();

    //     return redirect()->back()->with('success', 'status updated successfully!');
    // }


    public function updateStatuss($id)
    {
        $vehicle = TripGuideBook2::findOrFail($id);

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
                    'note'             => 'The refund for your Guide booking cancellation has been processed. #'.$vehicle->id,
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
                    'note'             => 'The amount for your Guide booking has been deducted. #'.$vehicle->id,
                    'status'           => 1,
                ]);

            $vehicle->status = 3;
        } elseif ($action == 'process') {

            $vehicle->status = 4;

        } else {

            return redirect()->back()->with('error', 'Invalid status update action.');
            
        }
    
        $vehicle->save();
    
        return redirect()->back()->with('success', 'status updated successfully!');
    }


    

    public function getCitiesByStatetripguide($stateId)
    {
        $cities = City::where('state_id', $stateId)->get(['id', 'city_name']);
        return response()->json(['cities' => $cities]);
    }



    protected function deleteFiles($files)
{
    // Define the base directory where files are stored (e.g., public/hotels/images)
    $basePath = public_path('uploads/image/trip_guide/');

    if (is_array($files)) {
        foreach ($files as $file) {
            $filePath = $basePath . '/' . $file;

            // Check if it's a file and delete it, otherwise skip
            if (file_exists($filePath) && !is_dir($filePath)) {
                unlink($filePath);  // Delete the file
            }
        }
    } elseif ($files) {
        $filePath = $basePath . '/' . $files;

        // Check if it's a file and delete it, otherwise skip
        if (file_exists($filePath) && !is_dir($filePath)) {
            unlink($filePath);  // Delete a single file
        }
    }
}



    function create(Request $request) {
        if($request->method()=='POST'){
            // $validated = $request->validate([           
            //     'cost' => 'required',
            //     'date	' => 'required',
            //     'vehicle' => 'required',
            //     'national_park' => 'required',
            //     'city_id' => 'required',
            //     'state_id' => 'required',
            //     'timing' => 'required',
            // ]);

            if ($request->hasFile('image')) {
                $imagePaths = [];
                foreach ($request->file('image') as $image) {
                    // Define the custom folder inside the public directory (you can change 'public/images')
                    $destinationPath = public_path('uploads/image/trip_guide/');
            
                    // Ensure the destination directory exists
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
            
                    // Get the original file name and store the image with the new name
                    $filename = time() . '_' . $image->getClientOriginalName();
                    
                    // Move the file to the destination
                    $image->move($destinationPath, $filename);
            
                    // Store the relative path of the image (to access via URL later)
                    $imagePaths[] = 'uploads/image/trip_guide/' . $filename;
                }
            } else {
                $imagePaths = null;
            }

            $agentCall = new TripGuide();
            $agentCall->location = $request->location;
            $agentCall->out_station_guide = $request->out_station_guide;
            $agentCall->languages_id = is_array($request->languages_id) ? implode(',', $request->languages_id) : $request->languages_id;
            $agentCall->local_guide = $request->local_guide;
            $agentCall->city_id = $request->city_id;
            $agentCall->image = $imagePaths ? json_encode($imagePaths) : null; 
            $agentCall->state_id = $request->state_id;
            $agentCall->cost = $request->cost;
            $agentCall->description = $request->description;
            $agentCall->guide_type = is_array($request->guide_type) ? implode(',', $request->guide_type) : $request->guide_type;
            $agentCall->save(); 

            return redirect()->route('tripguide')->with('success', 'Trip Guide added successfully!');
        }
        // $data['vehicle'] = Vehicle::orderBy('id','DESC')->where('id',$id)->first();
        $data['vehicleselect'] = Vehicle::orderBy('id','DESC')->get();
        $data['states'] = State::all();
        $data['languages'] = Languages::all();
        return view('admin/tripguide/create',$data);
    }


    public function destroy($id)
    {
        $agentCall = TripGuide::findOrFail($id); // Find the agent call by ID
        $agentCall->delete(); 

        return redirect()->back()->with('success', 'Trip Guide deleted successfully!');
    }


    public function edit($id)
    {
        $data['wildlifeSafari'] = TripGuide::findOrFail($id);
        $data['states'] = State::all(); 
        $data['languages'] = Languages::all();
        $data['cities'] = City::where('state_id', $data['wildlifeSafari']->state_id)->get(); 

        return view('admin/tripguide/edit',$data);
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
        $wildlifeSafari = TripGuide::findOrFail($id);

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
        $vehicle = TripGuide::findOrFail($id);
        $vehicle->status = ($vehicle->status == 1) ? 2 : 1;
        $vehicle->save();

        return redirect()->route('tripguide   ')->with('success', 'Outstation status updated successfully!');
    }

}
