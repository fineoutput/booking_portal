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
                    <h4 class="page-title">Add Outstation</h4>
                    <ol class="breadcrumb" style="display:none">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">CMS</a></li> -->
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Outstation</a></li>
                        <li class="breadcrumb-item active">Add Outstation</li>
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
                            <h4 class="mt-0 header-title">Add Outstation Form</h4>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                            <form action="{{ route('outstation_update', $Outstation->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') <!-- This is necessary for updating data using the PUT method -->
                                
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="trip_type">Route</label>
                                        <select class="form-control" id="trip_type" name="trip_type">
                                            <option value="">Select</option>
                                            @foreach($Route as $value)
                                                <option value="{{ $value->id }}" 
                                                    {{ isset($Outstation) && $Outstation->trip_type == $value->id ? 'selected' : '' }}>
                                                    {{ $value->from_destination }} - {{ $value->to_destination }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('trip_type')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <div class="col-sm-4">
                                        <label for="vehicle_type">Vehicle Type</label>
                                        <select class="form-control" id="vehicle_type" name="vehicle_type" required>
                                            <option value="">Select</option>
                                            @foreach($vehicleselect as $value)
                                                <option value="{{ $value->id }}" {{ $Outstation->vehicle_type == $value->id ? 'selected' : '' }}>
                                                    {{ $value->vehicle_type }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('vehicle_type')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="cost" name="cost" value="{{ old('cost', $Outstation->cost) }}" placeholder="Enter cost" required>
                                            <label for="cost">Enter Cost &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('cost')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="drop_point" name="drop_point" value="{{ old('drop_point', $Outstation->drop_point) }}" placeholder="Enter drop point" required>
                                            <label for="drop_point">Enter Drop Point &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('drop_point')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="available_km" name="available_km" value="{{ old('available_km', $Outstation->available_km) }}" placeholder="Enter available km" required>
                                            <label for="available_km">Enter Available KM &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('available_km')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="extra_km_charge" name="extra_km_charge" value="{{ old('extra_km_charge', $Outstation->extra_km_charge) }}" placeholder="Enter extra km charge" required>
                                            <label for="extra_km_charge">Enter Extra KM Charge &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('extra_km_charge')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-sm-12 mt-3">
                                        <label class="form-label" for="description">Description &nbsp;<span style="color:red;">*</span></label>
                                        <textarea class="form-control" name="description" id="description" required>{{ old('description', $Outstation->description) }}</textarea>
                                        @error('description')
                                            <div style="color:red">{{ $message }}</div>
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
    CKEDITOR.replace('description', {
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