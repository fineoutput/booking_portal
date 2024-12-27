@extends('admin.base_template')
@section('main')
<!-- Start content -->
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
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="state_id" value="" id="state_id" name="state_id" placeholder="Enter state_id" required>
                                            <label for="state_id"> State &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('state_id')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" value="" id="city_id" name="city_id" placeholder="ciyt" >
                                            <label for="city_id">City </label>
                                        </div>
                                        @error('city_id')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    
                                    <div class="form-group row">
                                        <div class="col-sm-6"><br>
                                            <label class="form-label" style="margin-left: 10px" for="power">Image</label>
                                            <input class="form-control" style="margin-left: 10px" type="file" name="image[]" multiple>
                                        </div>
                                        @error('image')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror

                                        <div class="col-sm-6"><br>
                                            <label class="form-label" style="margin-left: 10px" for="power">Video</label>
                                            <input class="form-control" style="margin-left: 10px" type="file" name="video[]" multiple>
                                        </div>
                                        @error('video')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                        <div class="col-sm-12 mt-3">
                                            <label class="form-label" for="power">Text Description &nbsp;<span style="color:red;">*</span></label>
                                            <textarea class="form-control" name="text_description" id="text_description" required>{{ old('text_description') }}</textarea>
                                            @error('text_description')
                                                <div style="color:red">{{$message}}</div>
                                            @enderror
                                        </div>
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
@endsection