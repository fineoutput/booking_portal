@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Add Package Agent Calls</h4>
                    <ol class="breadcrumb" style="display:none">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">CMS</a></li> -->
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Package Agent Calls</a></li>
                        <li class="breadcrumb-item active">Add Package Agent Calls</li>
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
                            <h4 class="mt-0 header-title">Add Package Agent Calls Form</h4>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                            <form action="{{ route('customer.update', $agent->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') <!-- This will ensure the form uses the PUT method for updating -->
                                
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" value="{{ old('name', $agent->name) }}" id="name" name="name" placeholder="Enter name" required>
                                            <label for="name">Enter Name &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('name')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="number" value="{{ old('phone', $agent->phone) }}" id="phone" name="phone" placeholder="Enter phone" required>
                                            <label for="phone">Phone &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('phone')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    {{-- <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" value="{{ old('state', $agent->state) }}" id="state" name="state" placeholder="Enter state" required>
                                            <label for="state">State &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('state')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" value="{{ old('city', $agent->city) }}" id="city" name="city" placeholder="Enter city" required>
                                            <label for="city">City &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('city')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div> --}}

                                    <div class="col-sm-4">
                                        <label for="state">State</label>
                                        <select class="form-control" id="state" name="state_id">
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}" {{ old('state_id', isset($agent) ? $agent->state_id : null) == $state->id ? 'selected' : '' }}>
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
                                        <select class="form-control" id="city" name="city">
                                        </select>
                                        @error('city')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" value="{{ old('package_enquiry_details', $agent->package_enquiry_details) }}" id="package_enquiry_details" name="package_enquiry_details" placeholder="Enter package_enquiry_details" required>
                                            <label for="package_enquiry_details">Package Enquiry Details &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('package_enquiry_details')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" value="{{ old('interest_details', $agent->interest_details) }}" id="interest_details" name="interest_details" placeholder="Enter interest_details" required>
                                            <label for="interest_details">Interest Details &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('interest_details')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <div class="col-sm-4 mt-2">
                                        <select class="form-control" name="mark_lead" id="mark_lead" required>
                                            <option value="">Please Select Mark Lead</option>
                                            <option value="1" {{ old('mark_lead', $agent->mark_lead) == 1 ? 'selected' : '' }}>Ongoing</option>
                                            <option value="2" {{ old('mark_lead', $agent->mark_lead) == 2 ? 'selected' : '' }}>Cancelled</option>
                                            <option value="3" {{ old('mark_lead', $agent->mark_lead) == 3 ? 'selected' : '' }}>Converted</option>
                                        </select>
                                        @error('mark_lead')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                </div>
                            
                                <div class="form-group row">
                                    <div class="form-group">
                                        <div class="w-100 text-center">
                                            <button type="submit" style="margin-top: 10px;" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                                        </div>
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
            loadCities(selectedState, "{{ old('city', isset($agent) ? $agent->city : '') }}");  // Preselect the city if it's available
        }

        // Fetch cities when state is changed
        $('#state').change(function() {
            let stateId = $(this).val();
            loadCities(stateId);  // Load cities based on selected state
        });

        function loadCities(stateId, selectedCity = null) {
            if (stateId) {
                $.ajax({
                     url: "{{ route('package_price_cities', ':stateId') }}".replace(':stateId', stateId),
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