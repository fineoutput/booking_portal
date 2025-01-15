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
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" type="text" value="" id="package_name" name="package_name" placeholder="Enter name" required>
                                            <label for="package_name">Enter Package Name &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('package_name')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    {{-- <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="state_id" value="" id="state_id" name="state_id" placeholder="Enter state_id" required>
                                            <label for="state_id"> State &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('state_id')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div> --}}


                                    {{-- <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" value="" id="city_id" name="city_id" placeholder="ciyt" >
                                            <label for="city_id">City </label>
                                        </div>
                                        @error('city_id')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div> --}}

                                    <div class="col-sm-4">
                                        <label for="state">State</label>
                                        <select class="form-control" id="state" name="state_id">
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

                                    <div class="col-sm-4">
                                        <label for="city">City</label>
                                        <div id="output"></div>
                                        <select data-placeholder="" class="form-control" id="city" class="chosen-select" name="city_id">
                                        </select>
                                        @error('city')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
{{-- 
                                    <div class="form-group row">
                                        <div class="col-sm-12"><br>
                                            <label class="form-label" style="margin-left: 10px" for="power">Select Package Multipal</label>
                                            <div id="output"></div>
                                            <select data-placeholder="" id="city" name="city_id[]" multiple class="chosen-select">
                                            </select>
                                            @error('city_id')
                                                <div style="color:red;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div> --}}

                                </div>
                                <div class="form-group row">
                                    
                                    <div class="form-group row">
                                        <div class="col-sm-6"><br>
                                            <label class="form-label" style="margin-left: 10px" for="power">Select Multipal Image</label>
                                            <input class="form-control" style="margin-left: 10px" type="file" name="image[]" multiple>
                                        </div>
                                        @error('image')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror

                                        <div class="col-sm-6"><br>
                                            <label class="form-label" style="margin-left: 10px" for="power">Video</label>
                                            <input class="form-control" style="margin-left: 10px" type="file" name="video[]" multiple>
                                            @error('video')
                                            <div style="color:red">{{$message}}</div>
                                            @enderror
                                        </div> 

                                        <div class="col-sm-6"><br>
                                            <label class="form-label" style="margin-left: 10px" for="power">Upload PDF</label>
                                             <input type="file" name="pdf" id="pdf" class="form-control" required>
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

<script>
    document.getElementById('output').innerHTML = location.search;
    $(".chosen-select").chosen();
</script>

<script>
    $(document).ready(function() {
        // Load cities for the selected state when the page loads
        let selectedState = $('#state').val();  // Get the selected state
        if (selectedState) {
            loadCities(selectedState, "{{ old('city', isset($user) ? $user->city : '') }}");  // Preselect the city if it's available
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