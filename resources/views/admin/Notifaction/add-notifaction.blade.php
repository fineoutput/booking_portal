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
                            <form action="{{ route('notificationstore') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <!-- Title Field -->
                                    <div class="col-sm-12 mt-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                                            <label for="title">Title &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('title')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <!-- Description Field -->
                                    <div class="col-sm-12 mt-3">
                                        <div class="form-floating">
                                            <textarea class="form-control" id="description" name="description" placeholder="Enter description" rows="4" required></textarea>
                                            <label for="description">Description &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('description')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <!-- Image Field -->
                                    <div class="col-sm-12 mt-3">
                                        <div class="form-floating">
                                            <input class="form-control" type="file" id="img" name="img" accept="image/*" required>
                                            <label for="img">Upload Image &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('img')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            
                                <!-- Submit Button -->
                                <div class="form-group row">
                                    <div class="form-group">
                                        <div class="w-100 text-center">
                                            <button type="submit" style="margin-top: 10px;" class="btn btn-danger">
                                                <i class="fa fa-user"></i> Submit
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