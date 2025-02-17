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
                    <h4 class="page-title">Add Trip Guide</h4>
                    <ol class="breadcrumb" style="display:none">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">CMS</a></li> -->
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Trip Guide</a></li>
                        <li class="breadcrumb-item active">Add Trip Guide</li>
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
                            <h4 class="mt-0 header-title">Add Trip Guide Form</h4>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                            <form action="{{route('tripguide_create')}}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
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
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" type="text" value="" id="location" name="location" placeholder="Enter location" required>
                                                <label for="location">Enter location &nbsp;<span style="color:red;">*</span></label>
                                            </div>
                                            @error('location')
                                            <div style="color:red">{{$message}}</div>
                                            @enderror
                                        </div>

                                        {{-- <div class="col-sm-4">
                                            <div class="form-floating">
                                                <input class="form-control" type="language" value="" id="language" name="language" placeholder="Enter language" required>
                                                <label for="language">language &nbsp;<span style="color:red;">*</span></label>
                                            </div>
                                            @error('language')
                                            <div style="color:red">{{$message}}</div>
                                            @enderror
                                        </div>
                                         --}}

                                        
                                    <div class="col-sm-4">
                                        <label for="languages">Language</label>
                                        <select data-placeholder="" class="form-control" id="languages" class="chosen-select" name="languages_id">
                                            @foreach($languages as $value)
                                            <option value="{{$value->id ?? ''}}">{{$value->language_name ?? ''}}</option>
                                            @endforeach
                                        </select>
                                        @error('languages')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                        <div class="col-sm-4">
                                            <div class="form-floating">
                                                <input class="form-control" type="local_guide" value="" id="local_guide" name="local_guide" placeholder="Enter local_guide" required>
                                                <label for="local_guide">Local Guide &nbsp;<span style="color:red;">*</span></label>
                                            </div>
                                            @error('local_guide')
                                            <div style="color:red">{{$message}}</div>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <div class="col-sm-4">
                                            <div class="form-floating">
                                                <input class="form-control" type="cost" value="" id="cost" name="cost" placeholder="Enter cost" required>
                                                <label for="cost"> Cost &nbsp;<span style="color:red;">*</span></label>
                                            </div>
                                            @error('cost')
                                            <div style="color:red">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-floating">
                                                <input class="form-control" type="out_station_guide" value="" id="out_station_guide" name="out_station_guide" placeholder="Enter out_station_guide" required>
                                                <label for="out_station_guide">Out Station Guide &nbsp;<span style="color:red;">*</span></label>
                                            </div>
                                            @error('out_station_guide')
                                            <div style="color:red">{{$message}}</div>
                                            @enderror
                                        </div>

                                    </div>

                                    
                                    <div class="form-group row">
                                        <div class="col-sm-4"><br>
                                            <label class="form-label" style="margin-left: 10px" for="power">Select Multiple Image</label>
                                            <input class="form-control" style="margin-left: 10px" type="file" value="" id="image" name="image[]" multiple>
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

@endsection