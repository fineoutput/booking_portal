@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Add Customer Calls</h4>
                    <ol class="breadcrumb" style="display:none">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">CMS</a></li> -->
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Customer Calls</a></li>
                        <li class="breadcrumb-item active">Add Customer Calls</li>
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
                            <h4 class="mt-0 header-title">Add Customer Calls Form</h4>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                            <form action="{{route('add_customer')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" type="text" value="" id="name" name="name" placeholder="Enter name" required>
                                            <label for="name">Enter Name &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('name')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="number" value="" id="phone" name="phone" placeholder="Enter phone" required>
                                            <label for="phone">Phone &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('phone')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" value="" id="state" name="state" placeholder="Enter state" required>
                                            <label for="state">State &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('state')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" value="" id="city" name="city" placeholder="Enter city" required>
                                            <label for="city">City &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('city')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" value="" id="package_enquiry_details" name="package_enquiry_details" placeholder="Enter package_enquiry_details" required>
                                            <label for="package_enquiry_details">Package Enquiry Details &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('package_enquiry_details')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" value="" id="interest_details" name="interest_details" placeholder="Enter interest_details" required>
                                            <label for="interest_details">Interest Details &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('interest_details')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-4 mt-2">
                                        <select class="form-control" name="mark_lead" id="mark_lead" required>
                                            <option value="">Please Select Mark lead</option>
                                            <option value="1">Ongoing</option>
                                            <option value="2">Cancelled</option>
                                            <option value="3">Converted</option>
                                        </select>
                                        <div class="form-floating">
                                            @error('power')
                                            <div style="color:red">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group row">
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