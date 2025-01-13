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
                            <form action="{{ route('roundtrip_update', $RoundTrip->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')  <!-- Use PUT for updating data -->
                                <div class="form-group row">
                                    
                                    <div class="col-sm-4">
                                        <label for="car_type_id">Vehicle Type</label>
                                        <select class="form-control" id="car_type_id" name="car_type_id" required>
                                            <option value="">Select</option>
                                            @foreach($vehicleselect as $value)
                                                <option value="{{ $value->id }}" {{ $RoundTrip->car_type_id == $value->id ? 'selected' : '' }}>
                                                    {{ $value->vehicle_type }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('car_type_id')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" value="{{ old('per_km_charge', $RoundTrip->per_km_charge) }}" id="per_km_charge" name="per_km_charge" placeholder="Enter Per KM Charge" required>
                                            <label for="per_km_charge">Enter Per KM Charge &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('per_km_charge')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                </div>
                            
                                <div class="form-group row">
                                    <div class="col-sm-12 mt-3">
                                        <label class="form-label" for="description">Description &nbsp;<span style="color:red;">*</span></label>
                                        <textarea class="form-control" name="description" id="description" required>{{ old('description', $RoundTrip->description) }}</textarea>
                                        @error('description')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <div class="w-100 text-center">
                                        <button type="submit" style="margin-top: 10px;" class="btn btn-danger">
                                            <i class="fa fa-user"></i> Submit
                                        </button>
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