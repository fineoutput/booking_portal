<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonials;


class TestimonialsController extends Controller
{
    function index() {
        $data['agent'] = Testimonials::orderBy('id','DESC')->get();
        return view('admin/testimonials/index',$data);
    }


  public function create(Request $request) {
        if($request->method() == 'POST') {
            $validated = $request->validate([
                'type' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            ]);
    
            $agentCall = new Testimonials();
            $agentCall->type = $request->type;
            $agentCall->title = $request->title;
            $agentCall->description = $request->description;
            $agentCall->status = '1';
    
            if ($request->hasFile('image')) {
                $image = $request->file('image');
    
                $folderName = 'testimonialsimage';
                $uploadPath = public_path('uploads/' . $folderName);
    
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
    
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
    
                $image->move($uploadPath, $imageName);
    
                $agentCall->image = 'uploads/' . $folderName . '/' . $imageName;
            }

            $agentCall->save();
    
            return redirect()->route('testimonials')->with('success', 'Testimonials added successfully!');
        }
        
        return view('admin/testimonials/create');
    }
    


    public function destroy($id)
    {
        $agentCall = Testimonials::findOrFail($id); // Find the agent call by ID
        $agentCall->delete();  // Delete the record

        return redirect()->route('testimonials')->with('success', 'Testimonials deleted successfully!');
    }


    public function edit($id)
    {
        $testimonials = Testimonials::findOrFail($id);  // Find the agent call by ID

        return view('admin/testimonials/edit', compact('testimonials'));  // Pass the data to the edit view
    }

   public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'type' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $agentCall = Testimonials::findOrFail($id);

        $agentCall->type = $request->type;
        $agentCall->title = $request->title;
        $agentCall->description = $request->description;

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($agentCall->image && file_exists(public_path($agentCall->image))) {
                unlink(public_path($agentCall->image));
            }

            $image = $request->file('image');
            $folderName = 'testimonialsimage';
            $uploadPath = public_path('uploads/' . $folderName);

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadPath, $imageName);

            $agentCall->image = 'uploads/' . $folderName . '/' . $imageName;
        }

        $agentCall->save();

        return redirect()->route('testimonials')->with('success', 'Testimonial updated successfully!');
    }
    
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'testimonials_type' => 'required',
    //         // 'description' => 'required',
    //     ]);

    //     $agentCall = Testimonials::findOrFail($id);  // Find the agent call by ID

    //     // Update the agent call with the new data
    //     $agentCall->testimonials_type = $request->testimonials_type;
    //     // $agentCall->description = $request->description;
    //     // $agentCall->status = '1';

    //     $agentCall->save();

    //     return redirect()->route('testimonials')->with('success', 'Vehicle updated successfully!');
    // }

    public function updateStatus($id)
    {

        $testimonials = Testimonials::findOrFail($id);
        $testimonials->status = ($testimonials->status == 1) ? 2 : 1;
        $testimonials->save();

        return redirect()->route('testimonials')->with('success', 'testimonials status updated successfully!');
    }

}
