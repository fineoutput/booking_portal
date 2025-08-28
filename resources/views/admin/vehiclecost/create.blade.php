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
                    <h4 class="page-title">Add Package Price</h4>
                    <ol class="breadcrumb" style="display:none">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">CMS</a></li> -->
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Package</a></li>
                        <li class="breadcrumb-item active">Add Package Price</li>
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
                            <h4 class="mt-0 header-title">Add Package Price Form</h4>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                           <form method="POST" action="{{ route('vehicle_cost', $id) }}">
                                @csrf
                               
                                <div class="form-group row">
                                    @php
                                        $vehicleCost = isset($vehicleCost) ? $vehicleCost : null;
                                    @endphp

                                    <div class="col-sm-6">
                                        <label class="form-label">Hatchback Cost <span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="hatchback_cost" value="{{ old('hatchback_cost', $vehicleCost->hatchback_cost ?? '') }}" >
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">Sedan Cost <span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="sedan_cost" value="{{ old('sedan_cost', $vehicleCost->sedan_cost ?? '') }}" >
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">Economy SUV Cost <span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="economy_suv_cost" value="{{ old('economy_suv_cost', $vehicleCost->economy_suv_cost ?? '') }}" >
                                    </div>

                                    {{-- <div class="col-sm-6">
                                        <label class="form-label">Luxury Sedan Cost <span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="luxury_sedan_cost" value="{{ old('luxury_sedan_cost', $vehicleCost->luxury_sedan_cost ?? '') }}" >
                                    </div> --}}

                                    {{-- <div class="col-sm-6">
                                        <label class="form-label">SUV Cost <span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="suv_cost" value="{{ old('suv_cost', $vehicleCost->suv_cost ?? '') }}" >
                                    </div> --}}

                                    <div class="col-sm-6">
                                        <label class="form-label">Premium SUV Cost <span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="luxury_suv_cost" value="{{ old('luxury_suv_cost', $vehicleCost->luxury_suv_cost ?? '') }}" >
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">Tempo Traveller(8-16 Seat) Cost <span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="traveller_mini_cost" value="{{ old('traveller_mini_cost', $vehicleCost->traveller_mini_cost ?? '') }}" >
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">Tempo Traveller(17-25 Seat) Cost <span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="traveller_big_cost" value="{{ old('traveller_big_cost', $vehicleCost->traveller_big_cost ?? '') }}" >
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">Urbania(12-17 Seat) Cost <span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="premium_traveller_cost" value="{{ old('premium_traveller_cost', $vehicleCost->premium_traveller_cost ?? '') }}" >
                                    </div>
{{-- 
                                    <div class="col-sm-6">
                                        <label class="form-label">MUV Cost <span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="muv_cost" value="{{ old('muv_cost', $vehicleCost->muv_cost ?? '') }}" >
                                    </div> --}}

                                    <div class="col-sm-6">
                                        <label class="form-label">Deluxe Bus Cost <span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="bus_nonac_cost" value="{{ old('bus_nonac_cost', $vehicleCost->bus_nonac_cost ?? '') }}" >
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">Luxury Bus Cost <span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="ac_coach_cost" value="{{ old('ac_coach_cost', $vehicleCost->ac_coach_cost ?? '') }}" >
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