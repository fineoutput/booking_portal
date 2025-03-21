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
                                            <option value="Standard" {{ old('hotel_category', $hotel->category) == 'Standard' ? 'selected' : '' }}>Standard (2 star)</option>
                                            <option value="Deluxe" {{ old('hotel_category', $hotel->category) == 'Deluxe' ? 'selected' : '' }}>Deluxe (3 star)</option>
                                            <option value="Super deluxe" {{ old('hotel_category', $hotel->category) == 'Super deluxe' ? 'selected' : '' }}>Super deluxe (premium 3 star)</option>
                                            <option value="Premium" {{ old('hotel_category', $hotel->category) == 'Premium' ? 'selected' : '' }}>Premium (4 star)</option>
                                            <option value="Luxury" {{ old('hotel_category', $hotel->category) == 'Luxury' ? 'selected' : '' }}>Luxury (5 star)</option>
                                            
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


                                    <div class="col-sm-12"><br>
                                        <label class="form-label" style="margin-left: 10px" for="power">Please Select Package</label>
                                        <div id="output"></div>
                                        {{-- <select data-placeholder="" name="package_id[]" multiple class="chosen-select">
                                            @foreach($packages as $value)
                                                <option value="{{ $value->id ?? '' }}" 
                                                    {{ in_array($value->id, explode(',', old('package_id', $hotel->package_id ?? ''))) ? 'selected' : '' }}>
                                                    {{ $value->package_name ?? '' }}
                                                </option>
                                            @endforeach
                                        </select> --}}
                                        <select data-placeholder="" name="package_id[]" multiple class="chosen-select">
                                            @foreach($packages as $value)
                                                <option value="{{ $value->id ?? '' }}" 
                                                    {{ in_array($value->id, explode(',', (is_array(old('package_id', $hotel->package_id ?? '')) ? implode(',', old('package_id', $hotel->package_id ?? '')) : (string) old('package_id', $hotel->package_id ?? ''))) ) ? 'selected' : '' }}>
                                                    {{ $value->package_name ?? '' }}
                                                </option>
                                            @endforeach
                                        </select>
                                        
                                        
                                        @error('property_id')
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