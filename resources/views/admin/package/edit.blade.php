@extends('admin.base_template')
@section('main')

<style>
    select#city {
    width: 337px;
    height: 200px;
}
ul#city-checkboxes {
    padding: 1pc;
}
.new {
    background: #f8f9fa;
    color: gray;
    border: none;
    width: 50%!important;
}

</style>
<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Add Package</h4>
                    <ol class="breadcrumb" style="display:none">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">CMS</a></li> -->
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Package</a></li>
                        <li class="breadcrumb-item active">Add Package</li>
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
                            <h4 class="mt-0 header-title">Add Package Form</h4>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                            <form action="{{ route('packages.update', $package->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') <!-- Use PUT method to indicate it's an update request -->
                                
                               <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="package_name">Package Name</label>
                                        <input type="text" name="package_name" value="{{ old('package_name', $package->package_name) }}" class="form-control">
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="service_charge" 
                                            name="service_charge" 
                                            value="{{ old('service_charge', $package->service_charge ?? '') }}" placeholder="Enter Service Charge" required>
                                        <label for="service_charge">Enter Service Charge &nbsp;<span style="color:red;">*</span></label>
                                    </div>
                                    @error('service_charge')
                                    <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>



                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label for="night_count">Night Count</label>
                                        <input type="text" name="night_count" value="{{ old('night_count', $package->night_count) }}" class="form-control">
                                    </div>
                                </div>
                                
                                {{-- <div class="form-group">
                                    <label for="package_name">State Name</label>
                                    <input type="text" name="state_id" value="{{ old('state_id', $package->state_id) }}" class="form-control">
                                </div>
                            
                                <div class="form-group">
                                    <label for="package_name">City Name</label>
                                    <input type="text" name="city_id" value="{{ old('city_id', $package->city_id) }}" class="form-control">
                                </div> --}}

                                {{-- <div class="col-sm-4">
                                    <label for="state">State</label>
                                    <select class="form-control" id="state" name="state_id">
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}" {{ old('state', isset($package) ? $package->state_id : null) == $state->id ? 'selected' : '' }}>
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
                                </div> --}}

                                {{-- <div class="col-sm-4">
                                    <div class="form-group">
                                    <select required class="selectpicker" id="state" name="state_id[]" multiple data-live-search="true">
                                        @foreach ($states as $state)
                                        <option value="{{ $state->id }}" {{ old('state', isset($user) ? $user->state : null) == $state->id ? 'selected' : '' }}>
                                            {{ $state->state_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    
                                    @error('state')
                                        <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>
                                </div> --}}

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="city">State</label>
                                        <br>
                                        <select class="selectpicker" id="state" name="state_id[]" multiple data-live-search="true">
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}" 
                                                    {{ in_array($state->id, old('state_id', isset($user) ? $user->state->pluck('id')->toArray() : [])) ? 'selected' : '' }}>
                                                    {{ $state->state_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                
                                        @error('state_id')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <div id="output"></div>

                                        <!-- Bootstrap Dropdown with Checkboxes -->
                                        <div class="dropdown">
                                            <button class="btn btn-light border dropdown-toggle w-100 text-start" type="button" id="cityDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                Select Cities
                                            </button>
                                            <ul class="dropdown-menu w-100" id="city-checkboxes" aria-labelledby="cityDropdown" style="max-height: 300px; overflow-y: auto;">
                                                <!-- Cities will be loaded here -->
                                            </ul>
                                        </div>

                                        @error('city')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                               <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Select Multipal Images</label>
                                    <input type="file" name="image[]" class="form-control" multiple>
                                    <small class="form-text text-muted">Leave blank to keep existing images.</small>
                                    @if($package->image)
                                        <div>
                                            @foreach(json_decode($package->image) as $key => $image)
                                                <div class="image-item">
                                                    <img src="{{ asset($image) }}" alt="Package Image" width="100" height="100">
                                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm remove-image" data-image="{{ $image }}" data-key="{{ $key }}">Remove</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                               </div>
                            
                               {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="video">Select Multipal Videos</label>
                                    <input type="file" name="video[]" class="form-control" multiple>
                                    <small class="form-text text-muted">Leave blank to keep existing videos.</small>
                                    @if($package->video)
                                        <div>
                                            @foreach(json_decode($package->video) as $video)
                                                <video width="150" controls>
                                                    <source src="{{ asset($video) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                               </div> --}}

                               <div class="col-md-6">
                                <div class="form-group">
                                    <label for="video">Select Multiple Videos</label>
                                    <input type="file" name="video[]" class="form-control" multiple>
                                    <small class="form-text text-muted">Leave blank to keep existing videos.</small>
                            
                                    @if($package->video)
                                        <div id="video-list">
                                            @foreach(json_decode($package->video) as $key => $video)
                                                <div class="video-item" data-key="{{ $key }}">
                                                    <video width="150" controls>
                                                        <source src="{{ asset($video) }}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm remove-video" data-video="{{ $video }}" data-key="{{ $key }}">Remove</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            


                               <div class="col-sm-6"><br>
                                <label class="form-label" style="margin-left: 10px" for="pdf">Upload PDF</label>
                                @if($package->pdf)
                                    <div>
                                        <a href="{{ asset($package->pdf) }}" target="_blank">View Current PDF</a>
                                    </div>
                                @endif
                                <input type="file" name="pdf" id="pdf" class="form-control">
                                @error('pdf')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="text_description">Text Description</label>
                                        <textarea name="text_description" class="form-control">{{ old('text_description', $package->text_description) }}</textarea>
                                    </div>
                                </div>
                                
                               <div class="col-md-12">
                                <div class="form-group">
                                    <label for="text_description_2">Text Description 2 </label>
                                    <textarea name="text_description_2" class="form-control">{{ old('text_description_2', $package->text_description_2) }}</textarea>
                                </div>
                               </div>
                               </div>
                               <input type="hidden" name="deleted_images" id="deleted_images" value="path/to/old_image1.jpg,path/to/old_image2.jpg">
                               <input type="hidden" id="deleted_videos" name="deleted_videos" value="">
                                
                                <button type="submit" class="btn btn-primary">Update Package</button>
                            </form>
                            
                            <!-- Hidden input to store deleted images -->
                           
                            
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
        <!-- end page content-->
    </div> <!-- container-fluid -->
</div> <!-- content -->



<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<link rel="stylesheet" href="https://harvesthq.github.io/chosen/chosen.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>



{{-- <script>
    $('#state').selectpicker();
</script> --}}

<script>
    $('#state').selectpicker();

    $('#state').selectpicker('refresh');
</script>


<script>
  document.getElementById('output').innerHTML = location.search;
  $(".chosen-select").chosen();
</script>


<script>
    // JavaScript to handle video removal
    document.querySelectorAll('.remove-video').forEach(function(button) {
        button.addEventListener('click', function() {
            var video = this.getAttribute('data-video'); // Get the video path
            var key = this.getAttribute('data-key'); // Get the key of the video in the array

            // Get the current deleted videos (from the hidden input field)
            var deletedVideos = document.getElementById('deleted_videos').value;

            // Add the video to the deleted videos list (separated by commas)
            if (deletedVideos) {
                deletedVideos += ',' + video;
            } else {
                deletedVideos = video;
            }

            // Update the hidden input field with the new deleted videos list
            document.getElementById('deleted_videos').value = deletedVideos;

            // Remove the video from the displayed form
            this.closest('.video-item').remove(); // Removes the video item from the form
        });
    });
</script>


<script>

function getSelectedValues() {
    const selectedStates = document.getElementById('state').selectedOptions;
    const selectedValues = Array.from(selectedStates).map(option => option.value);
    console.log("Selected values:", selectedValues);
}

$(document).ready(function() {

// Get the selected state values when the page loads
let selectedStates = $('#state').val();
if (selectedStates && selectedStates.length > 0) {
    console.log("Selected values on page load:", selectedStates);
    loadCities(selectedStates);  
}

// When the state selection changes
$('#state').change(function() {
    let stateIds = $(this).val(); 
    console.log(stateIds);
    loadCities(stateIds); 
    console.log("Selected values after change:", stateIds);
});


function loadCities(stateIds) {
    if (stateIds && stateIds.length > 0) {
        $('#city-checkboxes').empty();

        $.ajax({
            url: '/booking_portal/public/admin/cities',
            method: 'GET',
            data: { state_ids: stateIds },
            success: function(response) {
                let cities = response.cities;
                console.log(cities, 'Cities data');

                if (typeof cities === 'object') {
                    Object.keys(cities).forEach(function(stateId) {
                        let cityGroup = cities[stateId];

                        // Add a group label
                        $('#city-checkboxes').append('<li><h6 class="dropdown-header">State ' + stateId + '</h6></li>');

                        cityGroup.forEach(function(city) {
                            let checkboxHTML = `
                                <li>
                                    <div class="form-check px-3">
                                        <input class="form-check-input" type="checkbox" name="city_id[]" value="${city.id}" id="city_${city.id}">
                                        <label class="form-check-label" for="city_${city.id}">${city.city_name}</label>
                                    </div>
                                </li>
                            `;
                            $('#city-checkboxes').append(checkboxHTML);
                        });

                        $('#city-checkboxes').append('<li><hr class="dropdown-divider"></li>');
                    });
                }
            },
            error: function() {
                alert('Error fetching cities');
            }
        });
    } else {
        $('#city-checkboxes').empty().append('<li class="dropdown-item text-muted">Select a state first</li>');
    }
}



// Initialize Chosen.js (for state select)
$('#state').chosen({
    placeholder_text_multiple: "Select States"
});

// Initialize select2 for interests (if needed)
$('#interest').select2({
    placeholder: 'Select interests',
    allowClear: true
});
});

</script>

<script>
    // JavaScript to handle the image removal
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

            // Remove the image from the form
            this.closest('.image-item').remove(); // Removes the image from the displayed form
        });
    });
</script>

<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<link rel="stylesheet" href="https://harvesthq.github.io/chosen/chosen.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<script>
    CKEDITOR.replace('text_description', {
        toolbar: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList'] },
            { name: 'insert', items: ['Link', 'Unlink'] },
            { name: 'styles', items: ['Format', 'FontSize'] },
            { name: 'colors', items: ['TextColor', 'BGColor'] },
            { name: 'tools', items: ['Maximize'] }
        ],
        height: 200
    });

    // Initialize CKEditor for long description
    CKEDITOR.replace('text_description_2', {
        toolbar: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat'] },
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