@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Add Hotels Calls</h4>
                    <ol class="breadcrumb" style="display:none">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">CMS</a></li> -->
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Hotels Calls</a></li>
                        <li class="breadcrumb-item active">Add Hotels Calls</li>
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
                            <h4 class="mt-0 header-title">Add Hotels Calls Form</h4>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                            <form action="{{route('add_hotelsCalls')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" type="text" value="" id="name" name="name" placeholder="Enter name" required>
                                            <label for="name">Enter Name &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('name')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" type="text" value="" id="contact_person_name" name="contact_person_name" placeholder="Enter contact_person_name" required>
                                            <label for="contact_person_name">Enter Contact Person Name &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('contact_person_name')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" value="" id="room_details" name="room_details" placeholder="Enter room_details" required>
                                            <label for="room_details">Room Details &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('room_details')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" value="" id="cost_of_rooms" name="cost_of_rooms" placeholder="Enter cost_of_rooms" required>
                                            <label for="cost_of_rooms">Cost Of Rooms &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('cost_of_rooms')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="number" value="" id="phone" name="phone" placeholder="Enter phone" required>
                                            <label for="phone">Phone &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('phone')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>

                                    {{-- <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" value="" id="state" name="state" placeholder="Enter state" required>
                                            <label for="state">State &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('state')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" value="" id="city" name="city" placeholder="Enter city" required>
                                            <label for="city">City &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('city')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div> --}}


                                    <div class="col-sm-4">
                                        <label for="state">State</label>
                                        <select class="form-control" id="state" name="state">
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
                                        <select data-placeholder="" class="form-control" id="city" class="chosen-select" name="city">
                                        </select>
                                        @error('city')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>



                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" value="" id="location" name="location" placeholder="Enter location" required>
                                            <label for="location">Location &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('location')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group row">
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

@endsection