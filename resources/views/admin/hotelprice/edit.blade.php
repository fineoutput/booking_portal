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
                    <h4 class="page-title">Add Hotel Price</h4>
                    <ol class="breadcrumb" style="display:none">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">CMS</a></li> -->
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Hotel</a></li>
                        <li class="breadcrumb-item active">Add Hotel Price</li>
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
                            <h4 class="mt-0 header-title">Add Hotel Price Form</h4>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                            <form action="{{ route('hotel_price.update', $package->id ?? '') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') <!-- Use PUT method for editing data -->
                                <div class="form-group row">
                                    <!-- Standard Cost -->

                                    <div class="col-sm-6">
                                        <label for="start_date" class="form-label">Start Month &nbsp;<span style="color:red;">*</span></label>
                                        <input type="month" class="form-control" name="start_date"
                                         value="{{ old('start_date', $package->start_date) }}" required>
                                        @error('start_date')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="end_date" class="form-label">End Month &nbsp;<span style="color:red;">*</span></label>
                                        <input type="month" class="form-control" name="end_date" 
                                        value="{{ old('end_date', $package->end_date) }}" required>
                                        @error('end_date')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="night_cost" class="form-label">Hotel Night Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="night_cost" value="{{ old('night_cost', $package->night_cost) }}" required>
                                        @error('night_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            
                                <!-- Repeat similar blocks for other fields as needed... -->
                            
                                <div class="form-group">
                                    <div class="w-100 text-center">
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-user"></i> Update</button>
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