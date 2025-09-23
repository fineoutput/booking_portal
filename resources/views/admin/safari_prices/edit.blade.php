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

                        <form action="{{ route('safari_prices.update', $SafariPrices->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="start_month">Start Month <span style="color:red;">*</span></label>
                                    <input type="date" class="form-control" name="start_month" id="start_month"
                                        value="{{ old('start_month', isset($SafariPrices) ? $SafariPrices->start_month : '') }}">
                                    @error('start_month')
                                        <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label for="end_month">End Month <span style="color:red;">*</span></label>
                                    <input type="date" class="form-control" name="end_month" id="end_month"
                                        value="{{ old('end_month', isset($SafariPrices) ? $SafariPrices->end_month : '') }}">
                                    @error('end_month')
                                        <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-sm-6">
                                    <label for="visitor_type">Visitor Type <span style="color:red;">*</span></label>
                                    <select class="form-control" name="visitor_type" required>
                                        <option value="Indian" {{ $SafariPrices->visitor_type == 'Indian' ? 'selected' : '' }}>Indian</option>
                                        <option value="Foreigner" {{ $SafariPrices->visitor_type == 'Foreigner' ? 'selected' : '' }}>Foreigner</option>
                                    </select>
                                    @error('visitor_type')
                                    <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label for="day_type">Day Type <span style="color:red;">*</span></label>
                                    <select class="form-control" name="day_type" required>
                                        <option value="Weekday" {{ $SafariPrices->day_type == 'Weekday' ? 'selected' : '' }}>Weekday</option>
                                        <option value="Weekend" {{ $SafariPrices->day_type == 'Weekend' ? 'selected' : '' }}>Weekend</option>
                                    </select>
                                    @error('day_type')
                                    <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-group row">

                                <div class="col-sm-6">
                                    <label for="price_type">Price Type <span style="color:red;">*</span></label>
                                    <select class="form-control" name="price_type" required>
                                        <option value="Per_Seat" {{ $SafariPrices->price_type == 'Per_Seat' ? 'selected' : '' }}>Per Seat</option>
                                        <option value="Per_Jeep" {{ $SafariPrices->price_type == 'Per_Jeep' ? 'selected' : '' }}>Per Jeep</option>
                                    </select>
                                    @error('price_type')
                                    <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-floating">
                                        <input class="form-control" type="number" id="price" name="price" value="{{ $SafariPrices->price }}" placeholder="Enter Price" required>
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
                                        <i class="fa fa-user"></i> Update
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