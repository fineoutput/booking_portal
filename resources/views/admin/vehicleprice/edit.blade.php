@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Add Vehicle Price Edit</h4>
                    <ol class="breadcrumb" style="display:none">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">CMS</a></li> -->
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Vehicle Price Edit </a></li>
                        <li class="breadcrumb-item active">Add Vehicle</li>
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
                            <h4 class="mt-0 header-title">Add Vehicle Price Form</h4>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                            <form action="{{ route('vehiclepriceupdate', $VehiclePrice->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                            
                                    <div class="col-sm-6">
                                        <select class="form-control" name="type" id="type" required>
                                            <option value="">Select Tour Type</option>
                                            <option value="Airport/Railway station" {{ $VehiclePrice->type == 'Airport/Railway station' ? 'selected' : '' }}>
                                                Airport/Railway station
                                            </option>
                                            <option value="Local Tour" {{ $VehiclePrice->type == 'Local Tour' ? 'selected' : '' }}>
                                                Local Tour
                                            </option>
                                        </select>
                                        @error('type')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <input type="hidden" value="{{ $VehiclePrice->vehicle_id }}" name="vehicle_id">
                            
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" value="{{ old('price', $VehiclePrice->price) }}" id="price" name="price" placeholder="Enter Vehicle Price" required>
                                            <label for="price">Enter Price &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('price')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                </div>
                            
                                <div class="form-group row">
                            
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" value="{{ old('city', $VehiclePrice->city) }}" id="city" name="city" placeholder="Enter City" required>
                                            <label for="city">Enter City &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('city')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                </div>
                            
                                <div class="form-group row">
                                    <div class="col-sm-12 mt-3">
                                        <div class="form-floating">
                                            <textarea class="form-control" id="description" name="description" placeholder="Enter long description" rows="4" required>{{ old('description', $VehiclePrice->description) }}</textarea>
                                            <label for="description">Description &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('description')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <div class="form-group">
                                        <div class="w-100 text-center">
                                            <button type="submit" style="margin-top: 10px;" class="btn btn-danger"><i class="fa fa-user"></i> Submit</button>
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

<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
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

    CKEDITOR.replace('long_description', {
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