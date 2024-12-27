@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Add Hotel</h4>
                    <ol class="breadcrumb" style="display:none">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">CMS</a></li> -->
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Hotel</a></li>
                        <li class="breadcrumb-item active">Add Hotel</li>
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
                            <h4 class="mt-0 header-title">Add Hotel Form</h4>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                            <form action="{{ route('hotels.update', $hotel->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') <!-- Use PUT method to indicate it's an update request -->
                            
                                <!-- Hotel Name -->
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" value="{{ old('name', $hotel->name) }}" id="name" name="name" placeholder="Enter name" required>
                                            <label for="name">Enter Hotel Name &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('name')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <!-- Location -->
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" value="{{ old('location', $hotel->location) }}" id="location" name="location" placeholder="Enter location" required>
                                            <label for="location">Location &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('location')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <!-- Hotel Category -->
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" value="{{ old('hotel_category', $hotel->hotel_category) }}" id="hotel_category" name="hotel_category">
                                            <label for="hotel_category">Hotel Category</label>
                                        </div>
                                    </div>
                                </div>
                            
                                <!-- Package Selection -->
                                <div class="form-group row">
                                    <div class="col-sm-4 mt-2">
                                        <select class="form-control" name="package_id" id="package_id" required>
                                            <option value="1">Please select Package</option>
                                            @foreach($packages as $value)
                                            <option value="{{ $value->id }}" {{ $value->id == $hotel->package_id ? 'selected' : '' }}>
                                                {{ $value->package_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('package_id')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            
                                <!-- Image Selection (for Editing) -->
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label class="form-label" style="margin-left: 10px" for="images">Image</label>
                                        <input class="form-control" style="margin-left: 10px" type="file" id="images" name="images">
                                        <small class="form-text text-muted">Leave blank to keep existing image.</small>
                            
                                        <!-- Display current image if available -->
                                        @if($hotel->images)
                                        <div>
                                            <img src="{{ asset('storage/' . $hotel->images) }}" alt="Hotel Image" width="100" height="100">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            
                                <!-- Submit Button -->
                                <div class="form-group">
                                    <div class="w-100 text-center">
                                        <button type="submit" style="margin-top: 10px;" class="btn btn-danger"><i class="fa fa-user"></i> Update Hotel</button>
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
@endsection