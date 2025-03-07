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
                    <h4 class="page-title">Add City</h4>
                    <ol class="breadcrumb" style="display:none">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">CMS</a></li> -->
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Hotel</a></li>
                        <li class="breadcrumb-item active">Add City</li>
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
                            <h4 class="mt-0 header-title">Add City Form</h4>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                            <form action="{{ route('city.create') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">                            
                                    
                                    <div class="col-sm-4">
                                        <label for="state">State</label>
                                        <select class="form-control" id="state_id" name="state_id">
                                            <option value="">Select</option>
                                            @foreach($state as $value)
                                           <option value="{{$value->id ?? ''}}">{{$value->state_name ?? ''}}</option>
                                           @endforeach
                                        </select>
                                        @error('state_id')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="city_name" class="form-label">City Name &nbsp;<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" name="city_name" value="" required>
                                        @error('city_name')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="w-100 text-center">
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-user"></i> Submit</button>
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