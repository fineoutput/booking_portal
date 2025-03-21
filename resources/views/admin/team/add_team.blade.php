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
                    <h4 class="page-title">Add Team</h4>
                    <ol class="breadcrumb" style="display:none">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">CMS</a></li> -->
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Team</a></li>
                        <li class="breadcrumb-item active">Add Team</li>
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
                            <h4 class="mt-0 header-title">Add Team Form</h4>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                            <form action="{{route('add_team_process')}}" method="post" enctype="multipart/form-data">
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
                                            <input class="form-control" type="email" value="" id="email" name="email" placeholder="Enter email" required>
                                            <label for="email"> Email &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('email')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" value="" id="phone" name="phone" placeholder="phone no. (Optional)" onkeypress="return isNumberKey(event)" maxlength="10" minlength="10">
                                            <label for="phone">Phone (optional)</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" value="" id="address" name="address" placeholder="address(Optional)">
                                            <label for="address">Address (optional)</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="password" value="" id="password" name="password" placeholder="Enter Password" required>
                                            <label for="password">Password &nbsp;<span style="color:red;">*</span> </label>
                                        </div>
                                        @error('password')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4 mt-2">
                                        <select class="form-control" name="power" id="power" required>
                                            <option value="1">Please select Type</option>
                                            <option value="1">Super Admin</option>
                                            <option value="2">Admin</option>
                                            <option value="3">Manager</option>
                                            <option value="4">Caller/Sales Employee</option>
                                        </select>
                                        <div class="form-floating">
                                            @error('power')
                                            <div style="color:red">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4"><br>
                                            <label class="form-label" style="margin-left: 10px" for="power">Image</label>
                                            <input class="form-control" style="margin-left: 10px" type="file" value="" id="img" name="img">
                                        </div>
                                        <div class="col-sm-8 mt-3">
                                            <label class="form-label" for="power">Services &nbsp;<span style="color:red;">*</span></label>
                                            <div class="form-check-inline">
                                                <label class="form-check-label" for="check1">
                                                    <input type="checkbox" class="form-check-input" id="check1" name="service" value="999">All</label>
                                            </div>
                                           
                                            @if (!empty($service_data)) 
                                                @foreach ($service_data as $service)  
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label" for="<?= $service->id ?>">
                                                            <input type="checkbox" class="form-check-input" id="{{$service->id ?? ''}}" name="services[]" value="{{$service->id ?? ''}}">{{$service->name}}
                                                        </label>
                                                    </div>
                                            @endforeach 
                                             @endif
                                        </div>
                                    </div>


                                    
                                    {{-- <div class="form-group col-md-6">
                                        <div class="col-sm-12"><br>
                                            <label class="form-label" style="margin-left: 10px" for="power">Select Agent Calles</label>
                                        <div id="output"></div>
                                        <select data-placeholder="" name="agent_calles_id[]" multiple class="chosen-select">
                                            @foreach ($agentcalls as $value)
                                                <option value="{{$value->id ?? ''}}">{{$value->name ?? ''}}</option>
                                            @endforeach
                                        </select>
                                        @error('agent_calles_id')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                        </div>
                                    </div> --}}

                                    {{-- <div class="form-group col-md-6">
                                        <div class="col-sm-12"><br>
                                            <label class="form-label" style="margin-left: 10px" for="power">Select Hotel Calles</label>
                                        <div id="output"></div>
                                        <select data-placeholder="" name="hotels_calles_id[]" multiple class="chosen-select">
                                            @foreach ($hotelcalls as $value)
                                                <option value="{{$value->id ?? ''}}">{{$value->name ?? ''}}</option>
                                            @endforeach
                                        </select>
                                        @error('hotels_calles_id')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="col-sm-12"><br>
                                            <label class="form-label" style="margin-left: 10px" for="power">Select Customer Calles</label>
                                        <div id="output"></div>
                                        <select data-placeholder="" name="customer_calles_id[]" multiple class="chosen-select">
                                            @foreach ($customercalls as $value)
                                                <option value="{{$value->id ?? ''}}">{{$value->name ?? ''}}</option>
                                            @endforeach
                                        </select>
                                        @error('customer_calles_id')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                        </div>
                                    </div> --}}




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

<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<link rel="stylesheet" href="https://harvesthq.github.io/chosen/chosen.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<script>
    $(document).ready(function() {
        $('select').select2();  // Initializes Select2 on your select element
    });
</script>
<script>
    document.getElementById('output').innerHTML = location.search;
    $(".chosen-select").chosen();
</script>

@endsection