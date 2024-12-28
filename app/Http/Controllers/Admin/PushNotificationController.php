<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Services\GoogleAccessTokenService;

use App\Services\FirebaseService;

use App\Notifications\PushNotification;
use App\Models\PushNotificationModel;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // For date manipulation
use Illuminate\Support\Facades\Log;

class PushNotificationController extends Controller
{
    // protected $googleAccessTokenService;
    protected $firebaseService;

    // public function __construct(FirebaseService $firebaseService)
    // {
    //     $this->firebaseService = $firebaseService;
    // }

    public function index()
    {

        $notifications = PushNotificationModel::orderby('id', 'desc')->get();

        return view('admin.Notifaction.view-notifaction', compact('notifications'));
    }

    public function create(Request $request, $id = null)
    {
        $notifaction = null;

        if ($id !== null) {

            $admin_position = $request->session()->get('position');

            if ($admin_position !== "Super Admin") {

                return redirect()->route('promocode.index')->with('error', "Sorry You Don't Have Permission To edit Anything.");

            }

            $notifaction = PushNotificationModel::find(base64_decode($id));
            
        }

        return view('admin.Notifaction.add-notifaction', compact('notifaction'));
    }

    public function store(Request $request)
    {
         // Validate the incoming request
    $validated = $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Create a new notification entry
    $notification = new PushNotificationModel();
    $notification->title = $request->title;
    $notification->description = $request->description;

    // Capture the client's IP address and store it
    $notification->ip = $request->ip();  // This will store the client's IP address

    // Capture the current date and store it
    $notification->date = Carbon::now();  // This stores the current date and time
    $notification->is_active =  '1';  // This stores the current date and time
    $notification->added_by =  '1';  // This stores the current date and time

    // Check if the image has been uploaded
    if ($request->hasFile('img')) {
        // Get the uploaded file
        $file = $request->file('img');

        // Generate a unique file name
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Store the image in the 'public/notification' directory and get the relative file path
        $filePath = $file->storeAs('public/notification', $fileName);  // This stores the file in storage/app/public/notification

        // Store the file path in the database (relative to the 'public' disk)
        $notification->image = 'storage/notification/' . $fileName;
    }

    // Save the notification record
    $notification->save();
        // Return a success response or redirect
        return redirect()->route('notification')->with('success', 'Notification created successfully!');
    }

    }

