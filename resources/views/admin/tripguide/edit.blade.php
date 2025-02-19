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
                    <h4 class="page-title">Add Safari</h4>
                    <ol class="breadcrumb" style="display:none">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">CMS</a></li> -->
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Safari</a></li>
                        <li class="breadcrumb-item active">Add Safari</li>
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
                            <h4 class="mt-0 header-title">Add Safari Form</h4>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                            <form action="{{ route('tripguide.update', $wildlifeSafari->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') <!-- Since it's a PUT request for update -->
                            
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="state">State</label>
                                        <select class="form-control" id="state" name="state_id">
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}" {{ old('state_id', $wildlifeSafari->state_id) == $state->id ? 'selected' : '' }}>
                                                    {{ $state->state_name }}
                                                </option>
                                            @endforeach
                                        </select>
                            
                                        @error('state_id')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <div class="col-sm-4">
                                        <label for="city">City</label>
                                        <div id="output"></div>
                                        <select data-placeholder="" class="form-control" id="city" name="city_id">
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}" {{ old('city_id', $wildlifeSafari->city_id) == $city->id ? 'selected' : '' }}>
                                                    {{ $city->city_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('city_id')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" value="{{ old('location', $wildlifeSafari->location) }}" id="name" name="location" placeholder="Enter National Park" required>
                                            <label for="location">Enter location &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('location')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    {{-- <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" value="{{ old('language', $wildlifeSafari->language) }}" id="language" name="language" placeholder="Enter language" required>
                                            <label for="language">language &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('language')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div> --}}

                                    <div class="col-sm-4">
                                        <label for="languages">Language</label>
                                        <select class="form-control" id="languages" name="languages_id">
                                            @foreach($languages as $value)
                                                <option value="{{$value->id}}" 
                                                    @if($wildlifeSafari->languages_id == $value->id) selected @endif>
                                                    {{$value->language_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('languages')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
    <div class="col-sm-4">
        <label for="guide_type">Guide Type</label>
        <div id="output"></div>
        @php
            // Retrieve old input or use the saved value, converting it to an array.
            $selectedGuideTypes = old('guide_type', isset($wildlifeSafari) ? explode(',', $wildlifeSafari->guide_type) : []);
        @endphp
        <select name="guide_type[]" id="guide_type" multiple class="chosen-select" required>
            <option value="Local" {{ in_array('Local', $selectedGuideTypes) ? 'selected' : '' }}>Local</option>
            <option value="Outstation" {{ in_array('Outstation', $selectedGuideTypes) ? 'selected' : '' }}>Outstation</option>
        </select>
        @error('guide_type')
            <div style="color:red">{{ $message }}</div>
        @enderror
    </div>
</div>

                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" value="{{ old('local_guide', $wildlifeSafari->local_guide) }}" id="local_guide" name="local_guide" placeholder="Enter local_guide" required>
                                            <label for="local_guide">Local Guide &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('local_guide')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            

                                </div>
                            
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="number" value="{{ old('cost', $wildlifeSafari->cost) }}" id="cost" name="cost" placeholder="Enter cost" required>
                                            <label for="cost">Cost &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('cost')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" value="{{ old('out_station_guide', $wildlifeSafari->out_station_guide) }}" id="out_station_guide" name="out_station_guide" placeholder="Enter out_station_guide" required>
                                            <label for="out_station_guide">Out Station Guide &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('out_station_guide')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="form-group">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="images">Select Multiple Images</label>
                                        <input multiple type="file" name="image[]" class="form-control" multiple>
                                        <small class="form-text text-muted">Leave blank to keep existing images.</small>
                                        
                                        @if($wildlifeSafari->image)
                                            <div>
                                                @foreach(json_decode($wildlifeSafari->image) as $key => $image)
                                                    <div class="image-item">
                                                        <img src="{{ asset($image) }}" alt="Hotel Image" width="100" height="100">
                                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm remove-image" data-image="{{ $image }}" data-key="{{ $key }}">Remove</a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                </div>

                                <input type="hidden" name="deleted_images" id="deleted_images" value="">
                            
                                <div class="form-group">
                                    <div class="w-100 text-center">
                                        <button type="submit" style="margin-top: 10px;" class="btn btn-danger"><i class="fa fa-user"></i> Update</button>
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
            loadCities(selectedState, "{{ old('city_id', isset($wildlifeSafari) ? $wildlifeSafari->city_id : '') }}");  // Preselect the city if it's available
        }

        // Fetch cities when state is changed
        $('#state').change(function() {
            let stateId = $(this).val();
            loadCities(stateId);  // Load cities based on selected state
        });

        function loadCities(stateId, selectedCity = null) {
            if (stateId) {
                $.ajax({
                    url: '/admin/cities/' + stateId,
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