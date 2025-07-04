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
    select#city {
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
                            <form action="{{route('add_package')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" type="text" value="" id="package_name" name="package_name" placeholder="Enter name" required>
                                            <label for="package_name">Enter Package Name &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('package_name')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" type="text" value="" id="service_charge" name="service_charge" placeholder="Enter name" required>
                                            <label for="service_charge">Enter Services Charge &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('service_charge')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" type="text" value="" id="night_count" name="night_count" placeholder="Enter name" required>
                                            <label for="night_count">Night Count &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('night_count')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="state">State</label>
                                        <br>

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

                                    <div class="col-sm-6">
                                        <label for="city">City</label>
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle w-100 new" type="button" id="cityDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                Select Cities
                                            </button>
                                            <ul class="dropdown-menu w-100" id="city-checkboxes" aria-labelledby="cityDropdown" style="max-height: 300px; overflow-y: auto;">
                                                <!-- Checkboxes will be dynamically inserted here -->
                                            </ul>
                                        </div>

                                        @error('city')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                {{-- <div class="form-group row">
                                   
                                </div> --}}

                                <div class="form-group row">
                                    
                                    <div class="form-group row">
                                        <div class="col-sm-6"><br>
                                            <label class="form-label" style="margin-left: 10px" for="power">Select Multipal Image</label>
                                            <input required class="form-control" style="margin-left: 10px" type="file" name="image[]" multiple>
                                        </div>
                                        @error('image')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror

                                        <div class="col-sm-6"><br>
                                            <label class="form-label" style="margin-left: 10px" for="power">Video</label>
                                            <input  class="form-control" style="margin-left: 10px" type="file" name="video[]" multiple>
                                            @error('video')
                                            <div style="color:red">{{$message}}</div>
                                            @enderror
                                        </div> 

                                        <div class="col-sm-6"><br>
                                            <label class="form-label" style="margin-left: 10px" for="power">Upload PDF</label>
                                             <input  type="file" name="pdf" id="pdf" class="form-control" required>
                                            @error('video')
                                            <div style="color:red">{{$message}}</div>
                                            @enderror
                                        </div> 

                                        <div class="col-sm-12 mt-3">
                                            <label class="form-label" for="power">Text Description &nbsp;<span style="color:red;">*</span></label>
                                            <textarea class="form-control" name="text_description" id="text_description" required>{{ old('text_description') }}</textarea>
                                            @error('text_description')
                                                <div style="color:red">{{$message}}</div>
                                            @enderror
                                        </div>

                                        {{-- <div class="col-sm-12 mt-3">
                                            <div class="form-floating">
                                                <textarea class="form-control" id="text_description" name="text_description" placeholder="Enter short description" rows="4" required></textarea>
                                                <label for="text_description">Text Description &nbsp;<span style="color:red;">*</span></label>
                                            </div>
                                            @error('text_description')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div> --}}

                                        <div class="col-sm-12 mt-3">
                                            <label class="form-label" for="power">Text Description 2 &nbsp;<span style="color:red;">*</span></label>
                                            <textarea class="form-control" name="text_description_2" id="text_description_2" required>{{ old('text_description_2') }}</textarea>
                                            @error('text_description_2')
                                            <div style="color:red">{{$message}}</div>
                                        @enderror
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="w-100 text-center">
                                            <button type="submit" style="margin-top: 10px;" class="btn btn-danger"><i class="fa fa-user"></i> Submit</button>
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

<script>
      $('#state').selectpicker();
</script>

<script>
    document.getElementById('output').innerHTML = location.search;
    $(".chosen-select").chosen();
</script>

<script>

function getSelectedValues() {
    console.log('hii');
    $('select[name="state_id"]').on('change', function(){    
    alert($(this).val());    
});
       var state = document.getElementById('output').innerHTML = location.search;
        // var state = $(".chosen-select").chosen();
        // alert(location.search);
        // $('.chosen-select').change(function() {
        //     alert(state);
        // });
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

                if (typeof cities === 'object') {
                    Object.keys(cities).forEach(function(stateId) {
                        let cityGroup = cities[stateId];

                        
                        $data = State::where('id',stateId)->first();
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

                        // Divider between states (optional)
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