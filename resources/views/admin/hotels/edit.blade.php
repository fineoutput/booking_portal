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
                    <h4 class="page-title">Add Hotel</h4>
                    <ol class="breadcrumb" style="display:none">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">CMS</a></li> -->
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Hotel</a></li>
                        <li class="breadcrumb-item active">Add Hotel</li>
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
                            <form action="{{ route('hotels.update', $hotel->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') <!-- Use PUT method to indicate it's an update request -->
                            
                                <!-- Hotel Name -->
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" value="{{ old('name', $hotel->name) }}" id="name" name="name" placeholder="Enter name" required>
                                            <label for="name">Enter Hotel Name &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('name')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <!-- Location -->
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" value="{{ old('location', $hotel->location) }}" id="location" name="location" placeholder="Enter location" required>
                                            <label for="location">Location &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('location')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <!-- Hotel Category -->
                                    <div class="col-sm-4 mt-2">
                                        <select class="form-control" name="hotel_category" id="hotel_category" required>
                                            <option value="">Select Hotel Category</option>
                                            <option value="5 Star" {{ old('hotel_category', $hotel->category) == '5 Star' ? 'selected' : '' }}>5 Star</option>
                                            <option value="4 Star" {{ old('hotel_category', $hotel->category) == '4 Star' ? 'selected' : '' }}>4 Star</option>
                                            <option value="3 Star" {{ old('hotel_category', $hotel->category) == '3 Star' ? 'selected' : '' }}>3 Star</option>
                                            <option value="2 Star" {{ old('hotel_category', $hotel->category) == '2 Star' ? 'selected' : '' }}>2 Star</option>
                                            <option value="Dormetry" {{ old('hotel_category', $hotel->category) == 'Dormetry' ? 'selected' : '' }}>Dormetry</option>
                                            <option value="Villas / Homestay" {{ old('hotel_category', $hotel->category) == 'Villas / Homestay' ? 'selected' : '' }}>Villas / Homestay</option>
                                            <option value="Hostels" {{ old('hotel_category', $hotel->category) == 'Hostels' ? 'selected' : '' }}>Hostels</option>
                                        </select>
                                        <div class="form-floating">
                                            @error('hotel_category')
                                            <div style="color:red">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            
                                <!-- Package Selection -->
                                {{-- <div class="form-group row">
                                    <div class="col-sm-4 mt-2">
                                        <select class="form-control" name="package_id" id="package_id" required>
                                            <option value="1">Please select Package</option>
                                            @foreach($packages as $value)
                                            <option value="{{ $value->id }}" {{ $value->id == $hotel->package_id ? 'selected' : '' }}>
                                                {{ $value->package_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('package_id')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> --}}

                                <div class="form-group row">


                                    <div class="col-sm-4">
                                        <label for="state">State</label>
                                        <select class="form-control" id="state" name="state_id">
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}" {{ old('state', isset($hotel) ? $hotel->state_id : null) == $state->id ? 'selected' : '' }}>
                                                    {{ $state->state_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        
                                        @error('state')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
    
                                    <div class="col-sm-4">
                                        <label for="city">City</label>
                                        <select class="form-control" id="city" name="city_id">
                                        </select>
                                        @error('city')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-sm-6"><br>
                                        <label class="form-label" style="margin-left: 10px" for="power">Please Select Package</label>
                                        <div id="output"></div>
                                        <select data-placeholder="" name="package_id[]" multiple class="chosen-select">
                                            @foreach($packages as $value)
                                                <option value="{{ $value->id ?? '' }}" 
                                                    {{ in_array($value->id, explode(',', (is_array(old('package_id', $hotel->package_id ?? '')) ? implode(',', old('package_id', $hotel->package_id ?? '')) : (string) old('package_id', $hotel->package_id ?? ''))) ) ? 'selected' : '' }}>
                                                    {{ $value->package_name ?? '' }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('package_id')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6"><br>
                                        <label class="form-label" style="margin-left: 10px" for="meal_plan">Select Meal Multipal</label>
                                        <div id="output"></div>
                                        <select data-placeholder="" name="meal_plan[]" multiple class="chosen-select">
                                            <option value="meal_plan_only_room" 
                                                {{ in_array('meal_plan_only_room', explode(',', (is_array(old('meal_plan', $hotel->meal_plan ?? '')) ? implode(',', old('meal_plan', $hotel->meal_plan ?? '')) : (string) old('meal_plan', $hotel->meal_plan ?? '')))) ? 'selected' : '' }}>
                                                Meal Plan (Only Room)
                                            </option>
                                            <option value="meal_plan_breakfast" 
                                                {{ in_array('meal_plan_breakfast', explode(',', (is_array(old('meal_plan', $hotel->meal_plan ?? '')) ? implode(',', old('meal_plan', $hotel->meal_plan ?? '')) : (string) old('meal_plan', $hotel->meal_plan ?? '')))) ? 'selected' : '' }}>
                                                Meal Plan (Breakfast)
                                            </option>
                                            <option value="meal_plan_breakfast_lunch_dinner" 
                                                {{ in_array('meal_plan_breakfast_lunch_dinner', explode(',', (is_array(old('meal_plan', $hotel->meal_plan ?? '')) ? implode(',', old('meal_plan', $hotel->meal_plan ?? '')) : (string) old('meal_plan', $hotel->meal_plan ?? '')))) ? 'selected' : '' }}>
                                                Meal Plan (Breakfast + lunch/dinner)
                                            </option>
                                            <option value="meal_plan_all_meals" 
                                                {{ in_array('meal_plan_all_meals', explode(',', (is_array(old('meal_plan', $hotel->meal_plan ?? '')) ? implode(',', old('meal_plan', $hotel->meal_plan ?? '')) : (string) old('meal_plan', $hotel->meal_plan ?? '')))) ? 'selected' : '' }}>
                                                Meal Plan (All meals)
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
        {{ in_array('Public transport within 1 km', explode(',', (is_array(old('nearby', $hotel->nearby ?? '')) ? implode(',', old('nearby', $hotel->nearby ?? '')) : (string) old('nearby', $hotel->nearby ?? '')))) ? 'selected' : '' }}>
        Public transport within 1 km
    </option>
    <option value="Shopping centers within 1 km"
        {{ in_array('Shopping centers within 1 km', explode(',', (is_array(old('nearby', $hotel->nearby ?? '')) ? implode(',', old('nearby', $hotel->nearby ?? '')) : (string) old('nearby', $hotel->nearby ?? '')))) ? 'selected' : '' }}>
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
            {{ in_array('Other Popular Areas', explode(',', (is_array(old('locality', $hotel->locality ?? '')) ? implode(',', old('locality', $hotel->locality ?? '')) : (string) old('locality', $hotel->locality ?? '')))) ? 'selected' : '' }}>
            Other Popular Areas
        </option>
        <option value="Near Popular Attractions"
            {{ in_array('Near Popular Attractions', explode(',', (is_array(old('locality', $hotel->locality ?? '')) ? implode(',', old('locality', $hotel->locality ?? '')) : (string) old('locality', $hotel->locality ?? '')))) ? 'selected' : '' }}>
            Near Popular Attractions
        </option>
        <option value="Near Transit Hub(s)"
            {{ in_array('Near Transit Hub(s)', explode(',', (is_array(old('locality', $hotel->locality ?? '')) ? implode(',', old('locality', $hotel->locality ?? '')) : (string) old('locality', $hotel->locality ?? '')))) ? 'selected' : '' }}>
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
                {{ in_array($chain, explode(',', (is_array(old('chains', $hotel->chains ?? '')) ? implode(',', old('chains', $hotel->chains ?? '')) : (string) old('chains', $hotel->chains ?? '')))) ? 'selected' : '' }}>
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
                {{ in_array($amenity, explode(',', (is_array(old('hotel_amenities', $hotel->hotel_amenities ?? '')) ? implode(',', old('hotel_amenities', $hotel->hotel_amenities ?? '')) : (string) old('hotel_amenities', $hotel->hotel_amenities ?? '')))) ? 'selected' : '' }}>
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
                {{ in_array($room, explode(',', (is_array(old('room_amenities', $hotel->room_amenities ?? '')) ? implode(',', old('room_amenities', $hotel->room_amenities ?? '')) : (string) old('room_amenities', $hotel->room_amenities ?? '')))) ? 'selected' : '' }}>
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
                {{ in_array($rule, explode(',', (is_array(old('house_rules', $hotel->house_rules ?? '')) ? implode(',', old('house_rules', $hotel->house_rules ?? '')) : (string) old('house_rules', $hotel->house_rules ?? '')))) ? 'selected' : '' }}>
                {{ $rule }}
            </option>
        @endforeach
    </select>
    @error('house_rules')
        <div style="color:red;">{{ $message }}</div>
    @enderror
</div>
                                    
                                    
                                    

                                </div>
                            
                                <!-- Image Selection (for Editing) -->
                                <div class="form-group row">
                                    {{-- <div class="col-sm-4">
                                        <label class="form-label" style="margin-left: 10px" for="images">Image</label>
                                        <input class="form-control" style="margin-left: 10px" type="file" id="images" name="images[]" multiple>
                                        <small class="form-text text-muted">Leave blank to keep existing image.</small>
                            
                                        <!-- Display current image if available -->
                                        @if($hotel->images)
                                        @foreach (json_decode($hotel->images) as $key => $image)
                                        <div>
                                            <img src="{{ Storage::url($image) }}" alt="Image" style="width: 100px; height: auto; margin: 5px;">
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm remove-image" data-image="{{ $image }}" data-key="{{ $key }}">Remove</a>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div> --}}

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="images">Select Multiple Images</label>
                                            <input type="file" name="images[]" class="form-control" multiple>
                                            <small class="form-text text-muted">Leave blank to keep existing images.</small>
                                            
                                            @if($hotel->images)
                                                <div>
                                                    @foreach(json_decode($hotel->images) as $key => $image)
                                                        <div class="image-item">
                                                            <img src="{{ asset($image) }}" alt="Hotel Image" width="100" height="100">
                                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm remove-image" data-image="{{ $image }}" data-key="{{ $key }}">Remove</a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    

                                    <input type="hidden" name="deleted_images" id="deleted_images" value="">
                                </div>
                            
                                <!-- Submit Button -->
                                <div class="form-group">
                                    <div class="w-100 text-center">
                                        <button type="submit" style="margin-top: 10px;" class="btn btn-danger"><i class="fa fa-user"></i> Update Hotel</button>
                                    </div>
                                </div>
                            </form>
                            
                            
                            
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
        <!-- end page content-->
    </div> <!-- container-fluid -->
</div> <!-- content -->
<link rel="stylesheet" href="https://harvesthq.github.io/chosen/chosen.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
{{-- <script>
    $(document).ready(function() {
        $('select').select2();  // Initializes Select2 on your select element
    });
</script> --}}
<script>
    document.getElementById('output').innerHTML = location.search;
    $(".chosen-select").chosen();
</script>



<script>
    $(document).ready(function() {
        // Load cities for the selected state when the page loads
        let selectedState = $('#state').val();  // Get the selected state
        if (selectedState) {
            loadCities(selectedState, "{{ old('city_id', isset($hotel) ? $hotel->city_id : '') }}");  // Preselect the city if it's available
        }

        // Fetch cities when state is changed
        $('#state').change(function() {
            let stateId = $(this).val();
            loadCities(stateId);  // Load cities based on selected state
        });

        function loadCities(stateId, selectedCity = null) {
            if (stateId) {
                $.ajax({
                    url: '/booking_portal/public/admin/cities/' + stateId,
                    method: 'GET',
                    success: function(response) {
                        let cities = response.cities;
                        $('#city').empty().append('<option value="">Select a City</option>');
                        cities.forEach(function(city) {
                            // Append the city options
                            $('#city').append('<option value="' + city.id + '" ' + (selectedCity == city.id ? 'selected' : '') + '>' + city.city_name + '</option>');
                        });
                        $('#city').prop('disabled', false);
                    },
                    error: function() {
                        alert('Error fetching cities');
                    }
                });
            } else {
                $('#city').prop('disabled', true).empty().append('<option value="">Select a City</option>');
            }
        }

        // Initialize select2 for interests
        $('#interest').select2({
            placeholder: 'Select interests',
            allowClear: true
        });
    });
</script>

<script>
    document.querySelectorAll('.remove-image').forEach(function(button) {
        button.addEventListener('click', function() {
            var image = this.getAttribute('data-image'); // Get the image path
            var key = this.getAttribute('data-key'); // Get the key of the image in the array

            // Get the current deleted images (from the hidden input field)
            var deletedImages = document.getElementById('deleted_images').value;

            // Add the image to the deleted images list (separated by commas)
            if (deletedImages) {
                deletedImages += ',' + image;
            } else {
                deletedImages = image;
            }

            // Update the hidden input field with the new deleted images list
            document.getElementById('deleted_images').value = deletedImages;

            // Remove the image from the form display (UI)
            this.closest('.image-item').remove();
        });
    });
</script>


@endsection