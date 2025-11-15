@extends('admin.base_template')
@section('main')
<!-- Start content -->
<style>
  
    form {
      margin-top: 20px;
    }
    
    select {
      width: 400px;
    }
    </style>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Add Room</h4>
                    <ol class="breadcrumb" style="display:none">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">CMS</a></li> -->
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Room</a></li>
                        <li class="breadcrumb-item active">Add Room</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="page-content-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <!-- show success and error messages -->
                            @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </div>
                            @endif
                            @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </div>
                            @endif
                            <!-- End show success and error messages -->
                            <h4 class="mt-0 header-title">Add Hotel Form</h4>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                            
                            <form action="{{ route('hotels_room.update', $hotel_room->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') {{-- Use PUT or PATCH for update --}}

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" value="{{ $hotel_room->title }}" id="title" name="title" placeholder="Enter title" required>
                                            <label for="name">Enter Title &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('title')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>

      
                                    <div class="col-sm-6"><br>
                                        <label class="form-label" style="margin-left: 10px" for="meal_plan">Select Meal Multipal</label>
                                        <div id="output"></div>
                                        <select data-placeholder="" name="meal_plan[]" multiple class="chosen-select">
                                            <option value="meal_plan_only_room" 
                                                {{ in_array('meal_plan_only_room', explode(',', (is_array(old('meal_plan', $hotel_room->meal_plan ?? '')) ? implode(',', old('meal_plan', $hotel_room->meal_plan ?? '')) : (string) old('meal_plan', $hotel_room->meal_plan ?? '')))) ? 'selected' : '' }}>
                                                Meal Plan (Only Room)
                                            </option>
                                            <option value="meal_plan_breakfast" 
                                                {{ in_array('meal_plan_breakfast', explode(',', (is_array(old('meal_plan', $hotel_room->meal_plan ?? '')) ? implode(',', old('meal_plan', $hotel_room->meal_plan ?? '')) : (string) old('meal_plan', $hotel_room->meal_plan ?? '')))) ? 'selected' : '' }}>
                                                Meal Plan (Breakfast)
                                            </option>
                                            <option value="meal_plan_all_meals" 
                                                {{ in_array('meal_plan_all_meals', explode(',', (is_array(old('meal_plan', $hotel_room->meal_plan ?? '')) ? implode(',', old('meal_plan', $hotel_room->meal_plan ?? '')) : (string) old('meal_plan', $hotel_room->meal_plan ?? '')))) ? 'selected' : '' }}>
                                                Meal Plan (All meals)
                                            </option>
                                            <option value="meal_plan_breakfast_lunch_dinner" 
                                                {{ in_array('meal_plan_breakfast_lunch_dinner', explode(',', (is_array(old('meal_plan', $hotel_room->meal_plan ?? '')) ? implode(',', old('meal_plan', $hotel_room->meal_plan ?? '')) : (string) old('meal_plan', $hotel_room->meal_plan ?? '')))) ? 'selected' : '' }}>
                                                Meal Plan (Breakfast + lunch/dinner)
                                            </option>
                                            
                                        </select>
                                        @error('meal_plan')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6"><br>
    <label class="form-label" style="margin-left: 10px">Nearby within Walking Distance</label>
    <div id="output"></div>
    <select name="nearby[]" multiple class="chosen-select">
    <option value="Public transport within 1 km"
        {{ in_array('Public transport within 1 km', explode(',', (is_array(old('nearby', $hotel_room->nearby ?? '')) ? implode(',', old('nearby', $hotel_room->nearby ?? '')) : (string) old('nearby', $hotel_room->nearby ?? '')))) ? 'selected' : '' }}>
        Public transport within 1 km
    </option>
    <option value="Shopping centers within 1 km"
        {{ in_array('Shopping centers within 1 km', explode(',', (is_array(old('nearby', $hotel_room->nearby ?? '')) ? implode(',', old('nearby', $hotel_room->nearby ?? '')) : (string) old('nearby', $hotel_room->nearby ?? '')))) ? 'selected' : '' }}>
        Shopping centers within 1 km
    </option>
</select>

    @error('nearby')
        <div style="color:red;">{{ $message }}</div>
    @enderror
</div>

<div class="col-sm-6"><br>
    <label class="form-label" style="margin-left: 10px">Locality</label>
    <div id="output"></div>
    <select data-placeholder="" name="locality[]" multiple class="chosen-select">
        <option value="Other Popular Areas"
            {{ in_array('Other Popular Areas', explode(',', (is_array(old('locality', $hotel_room->locality ?? '')) ? implode(',', old('locality', $hotel_room->locality ?? '')) : (string) old('locality', $hotel_room->locality ?? '')))) ? 'selected' : '' }}>
            Other Popular Areas
        </option>
        <option value="Near Popular Attractions"
            {{ in_array('Near Popular Attractions', explode(',', (is_array(old('locality', $hotel_room->locality ?? '')) ? implode(',', old('locality', $hotel_room->locality ?? '')) : (string) old('locality', $hotel_room->locality ?? '')))) ? 'selected' : '' }}>
            Near Popular Attractions
        </option>
        <option value="Near Transit Hub(s)"
            {{ in_array('Near Transit Hub(s)', explode(',', (is_array(old('locality', $hotel_room->locality ?? '')) ? implode(',', old('locality', $hotel_room->locality ?? '')) : (string) old('locality', $hotel_room->locality ?? '')))) ? 'selected' : '' }}>
            Near Transit Hub(s)
        </option>
    </select>
    @error('locality')
        <div style="color:red;">{{ $message }}</div>
    @enderror
</div>

<div class="col-sm-6"><br>
    <label class="form-label" style="margin-left: 10px">Chains</label>
    <div id="output"></div>
    <select data-placeholder="" name="chains[]" multiple class="chosen-select">
        @foreach (['Marriott, Westin & Le Meridien','Moustache','Oyo Hotels','Sarovar','StayVista','Sterling Holiday resorts','Taj','Treebo Hotels','Zostel'] as $chain)
            <option value="{{ $chain }}"
                {{ in_array($chain, explode(',', (is_array(old('chains', $hotel_room->chains ?? '')) ? implode(',', old('chains', $hotel_room->chains ?? '')) : (string) old('chains', $hotel_room->chains ?? '')))) ? 'selected' : '' }}>
                {{ $chain }}
            </option>
        @endforeach
    </select>
    @error('chains')
        <div style="color:red;">{{ $message }}</div>
    @enderror
</div>

<div class="col-sm-6"><br>
    <label class="form-label" style="margin-left: 10px">Hotel Amenities</label>
    <div id="output"></div>
    <select data-placeholder="" name="hotel_amenities[]" multiple class="chosen-select">
        @foreach (['Room Service','Balcony/Terrace','Barbeque','Cafe','EV Charging Station','Restaurant','Bar','Parking','Caretaker','Bonfire','Kitchenette','Elevator/Lift','Indoor Games','Living Room'] as $amenity)
            <option value="{{ $amenity }}"
                {{ in_array($amenity, explode(',', (is_array(old('hotel_amenities', $hotel_room->hotel_amenities ?? '')) ? implode(',', old('hotel_amenities', $hotel_room->hotel_amenities ?? '')) : (string) old('hotel_amenities', $hotel_room->hotel_amenities ?? '')))) ? 'selected' : '' }}>
                {{ $amenity }}
            </option>
        @endforeach
    </select>
    @error('hotel_amenities')
        <div style="color:red;">{{ $message }}</div>
    @enderror
</div>

<div class="col-sm-6"><br>
    <label class="form-label" style="margin-left: 10px">Room Amenities</label>
    <div id="output"></div>
    <select data-placeholder="" name="room_amenities[]" multiple class="chosen-select">
        @foreach (['Fireplace','Interconnected Room','Bathtub','Kitchenette','Smoking Room','Private Pool','Balcony','Cook & Butler Service','Heater','Jacuzzi','Living Area'] as $room)
            <option value="{{ $room }}"
                {{ in_array($room, explode(',', (is_array(old('room_amenities', $hotel_room->room_amenities ?? '')) ? implode(',', old('room_amenities', $hotel_room->room_amenities ?? '')) : (string) old('room_amenities', $hotel_room->room_amenities ?? '')))) ? 'selected' : '' }}>
                {{ $room }}
            </option>
        @endforeach
    </select>
    @error('room_amenities')
        <div style="color:red;">{{ $message }}</div>
    @enderror
</div>

<div class="col-sm-6"><br>
    <label class="form-label" style="margin-left: 10px">House Rules</label>
    <div id="output"></div>
    <select data-placeholder="" name="house_rules[]" multiple class="chosen-select">
        @foreach (['Smoking Allowed','Unmarried Couples Allowed','Pets Allowed','Alcohol Allowed','Non Veg Allowed'] as $rule)
            <option value="{{ $rule }}"
                {{ in_array($rule, explode(',', (is_array(old('house_rules', $hotel_room->house_rules ?? '')) ? implode(',', old('house_rules', $hotel_room->house_rules ?? '')) : (string) old('house_rules', $hotel_room->house_rules ?? '')))) ? 'selected' : '' }}>
                {{ $rule }}
            </option>
        @endforeach
    </select>
    @error('house_rules')
        <div style="color:red;">{{ $message }}</div>
    @enderror
</div>

        {{-- Existing Images (optional preview) --}}
 @if($hotel_room->images)
    <div class="col-sm-12 mt-3">
        <label>Existing Images:</label><br>
        @foreach(json_decode($hotel_room->images, true) as $key => $img)
            <div style="display:inline-block; margin:5px; position:relative;">
                <img src="{{ asset($img) }}" alt="Room Image" width="100" height="100" style="object-fit:cover; border:1px solid #ccc;">
                
                {{-- Remove checkbox --}}
                <label style="display:block; text-align:center; font-size:12px;">
                    <input type="checkbox" name="remove_images[]" value="{{ $img }}">
                    Remove
                </label>
            </div>
        @endforeach
    </div>
@endif



        {{-- Upload new images --}}
        <div class="col-sm-6 mt-4">
            <label class="form-label" for="images">Upload More Images</label>
            <input class="form-control" type="file" id="images" name="images[]" multiple>
        </div>

        <div class="col-sm-12 mt-3">
    <label class="form-label" for="power">
        Description <span style="color:red;">*</span>
    </label>

    <textarea class="form-control" name="description" id="description" required>
        {{ old('description', $hotel_room->description ?? '') }}
    </textarea>

    @error('description')
        <div style="color:red">{{ $message }}</div>
    @enderror
</div>

        {{-- Submit --}}
        <div class="form-group col-12 text-center mt-4">
            <button type="submit" class="btn btn-primary">Update Room</button>
        </div>
    </div>
</form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </div> 
</div> 

<link rel="stylesheet" href="https://harvesthq.github.io/chosen/chosen.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<script>
    document.getElementById('output').innerHTML = location.search;
    $(".chosen-select").chosen();
</script>


<script>

    CKEDITOR.replace('description', {
        toolbar: [
            { name: 'basicstyles', items: ['Italic', 'Underline', 'Strike', 'RemoveFormat'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList'] },
            { name: 'insert', items: ['Link', 'Unlink', 'Image'] },
            { name: 'styles', items: ['Format', 'FontSize'] },
            { name: 'colors', items: ['TextColor', 'BGColor'] },
            { name: 'tools', items: ['Maximize'] }
        ],
        height: 300
    });
</script>

@endsection