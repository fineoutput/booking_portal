@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Add Vehicle</h4>
                    <ol class="breadcrumb" style="display:none">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">CMS</a></li> -->
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Vehicle</a></li>
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
                            <h4 class="mt-0 header-title">Add Vehicle Form</h4>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                            <form action="{{ route('vehicle.update', $agent->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') <!-- Use PUT method for updating the resource -->
                                
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <div class="form-floating">
                                            <!-- Pre-fill the 'vehicle_type' input with the existing data -->
                                            <input type="text" class="form-control" id="vehicle_type" name="vehicle_type" value="{{ old('vehicle_type', $agent->vehicle_type) }}" placeholder="Enter Vehicle type" required>
                                            <label for="vehicle_type">Enter Vehicle type &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('vehicle_type')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-12 mt-3">
                                        <label class="form-label" for="power">Image &nbsp;<span style="color:red;">*</span></label>
                                        <input type="file" class="form-control" type="text" value="" id="image" name="image" placeholder="Enter Vehicle type" required>

                                        <img height="50px"  width="50px" src="{{asset($agent->image)}}" alt="">

                                        @error('image')
                                        <div style="color:red">{{$message}}</div>
                                    @enderror
                                    </div>
                            
                                    {{-- <div class="col-sm-12 mt-3">
                                        <label class="form-label" for="description">Description &nbsp;<span style="color:red;">*</span></label>
                                        <!-- Pre-fill the 'description' field with the existing data -->
                                        <textarea class="form-control" name="description" id="description" required>{{ old('description', $agent->description) }}</textarea>
                                        @error('description')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                                </div>
                            
                                <div class="form-group row">
                                    <div class="form-group">
                                        <div class="w-100 text-center">
                                            <button type="submit" style="margin-top: 10px;" class="btn btn-danger">
                                                <i class="fa fa-user"></i> Update
                                            </button>
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
@endsection