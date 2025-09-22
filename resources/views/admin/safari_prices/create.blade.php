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
                    <h4 class="page-title">Add Safari Price</h4>
                    <ol class="breadcrumb" style="display:none">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">CMS</a></li> -->
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Safari Price</a></li>
                        <li class="breadcrumb-item active">Add Safari Price</li>
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
                            <h4 class="mt-0 header-title">Add Safari Price Form</h4>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">

                          <form action="{{ route('safari_prices_create', $WildlifeSafari->id) }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">

                                <div class="col-sm-6">
                                    {{-- <div class="form-floating"> --}}
                                        <label for="visitor_type">Visitor Type <span style="color:red;">*</span></label>
                                        <select class="form-control" name="visitor_type" id="">
                                            <option value="Indian">Indian</option>
                                            <option value="Foreigner">Foreigner</option>
                                        </select>
                                    {{-- </div> --}}
                                    @error('visitor_type')
                                    <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    {{-- <div class="form-floating"> --}}
                                        <label for="day_type">Day Type <span style="color:red;">*</span></label>
                                        <select class="form-control" name="day_type" id="">
                                            <option value="Weekday">Weekday</option>
                                            <option value="Weekend">Weekend</option>
                                        </select>
                                    {{-- </div> --}}
                                    @error('day_type')
                                    <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-group row">

                                <div class="col-sm-6">
                                    {{-- <div class="form-floating"> --}}
                                        <label for="price_type">Price Type <span style="color:red;">*</span></label>
                                        <select class="form-control" name="price_type" id="">
                                            <option value="Per_Seat">Per Seat</option>
                                            <option value="Per_Jeep">Per Jeep</option>
                                        </select>
                                    {{-- </div> --}}
                                    @error('price_type')
                                    <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-floating">
                                        <input class="form-control" type="number" id="price" name="price" placeholder="Enter Price" required>
                                        <label for="price">Price <span style="color:red;">*</span></label>
                                    </div>
                                    @error('price')
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


@endsection