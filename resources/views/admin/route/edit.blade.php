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
                    <h4 class="page-title">Edit Route</h4> <!-- Updated title -->
                    <ol class="breadcrumb" style="display:none">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Route</a></li>
                        <li class="breadcrumb-item active">Edit Route</li>
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
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @endif
                            @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @endif
                            <!-- End show success and error messages -->
                            <h4 class="mt-0 header-title">Edit Route Form</h4> <!-- Updated header -->
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                            <form action="{{ route('route.update', $route->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') <!-- For update operation -->

                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" value="{{ old('from_destination', $route->from_destination) }}" id="from_destination" name="from_destination" placeholder="Enter name" required>
                                            <label for="from_destination">Enter Starting Destination <span style="color:red;">*</span></label>
                                        </div>
                                        @error('from_destination')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" value="{{ old('to_destination', $route->to_destination) }}" id="to_destination" name="to_destination" placeholder="Enter Ending Destination" required>
                                            <label for="to_destination">Enter Ending Destination <span style="color:red;">*</span></label>
                                        </div>
                                        @error('to_destination')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="city_image">City Image</label>
                                            <input type="file" class="form-control-file" id="city_image" name="city_image" accept="image/*">
                                            @if ($route->city_image)
                                                <div style="margin-top: 10px;">
                                                    <img src="{{ asset('storage/' . $route->city_image) }}" alt="Current City Image" style="max-width: 100px; max-height: 100px;">
                                                    <p><small>Current Image: {{ $route->city_image }}</small></p>
                                                </div>
                                            @endif
                                        </div>
                                        @error('city_image')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="w-100 text-center">
                                        <button type="submit" style="margin-top: 10px;" class="btn btn-danger"><i class="fa fa-user"></i> Update</button> <!-- Changed to "Update" -->
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