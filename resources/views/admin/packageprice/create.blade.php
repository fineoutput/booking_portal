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
                            <form action="{{ route('package_price_create', $package->id ?? '') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">                            
                                    <!-- Multiple Costs -->

                                    <div class="col-sm-6">
                                        <label for="start_date" class="form-label">Start Month &nbsp;<span style="color:red;">*</span></label>
                                        <input type="month" class="form-control" name="start_date" value="" required>
                                        @error('start_date')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="end_date" class="form-label">End Month &nbsp;<span style="color:red;">*</span></label>
                                        <input type="month" class="form-control" name="end_date" value="" required>
                                        @error('end_date')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="standard_cost" class="form-label">Standard (1 star) Hotel category Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="standard_cost" value="" required>
                                        @error('standard_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <div class="col-sm-6">
                                        <label for="deluxe_cost" class="form-label">Deluxe (2 star) Hotel category Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="deluxe_cost" value="" required>
                                        @error('deluxe_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    </div>
                                    <div class="form-group row"> 
                            
                                    <div class="col-sm-6">
                                        <label for="super_deluxe_cost" class="form-label">Super Deluxe (3 star) Hotel categoryCost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="super_deluxe_cost" value="" required>
                                        @error('super_deluxe_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <div class="col-sm-6">
                                        <label for="luxury_cost" class="form-label">Luxury (4 star) Hotel category Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="luxury_cost" value="" required>
                                        @error('luxury_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    </div>

                                    <div class="form-group row"> 
                                            
                                    <div class="col-sm-6">
                                        <label for="premium_cost" class="form-label">Premium (5 star) Hotel category Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="premium_cost" value="" required>
                                        @error('premium_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    </div>
                                    <div class="form-group row"> 
                            
                                    <div class="col-sm-6">
                                        <label for="nights_cost" class="form-label">Per Night Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="nights_cost" value="" required>
                                        @error('nights_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <div class="col-sm-6">
                                        <label for="adults_cost" class="form-label">Adults Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="adults_cost" value="" required>
                                        @error('adults_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    </div>
                                    <div class="form-group row"> 
                            
                                    <div class="col-sm-6">
                                        <label for="child_with_bed_cost" class="form-label">Child With Bed Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="child_with_bed_cost" value="" required>
                                        @error('child_with_bed_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <div class="col-sm-6">
                                        <label for="child_no_bed_infant_cost" class="form-label">Child With No Bed (Infant) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="child_no_bed_infant_cost" value="" required>
                                        @error('child_no_bed_infant_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    </div>
                            
                                 <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="child_no_bed_child_cost" class="form-label">Child With No Bed (Child) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="child_no_bed_child_cost" value="" required>
                                        @error('child_no_bed_child_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="meal_plan_only_room_cost" class="form-label">Meal Plan (Only Room) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="meal_plan_only_room_cost" value="" required>
                                        @error('meal_plan_only_room_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>


                                 <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="meal_plan_breakfast_cost" class="form-label">Meal Plan (Breakfast) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="meal_plan_breakfast_cost" value="" required>
                                        @error('meal_plan_breakfast_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="meal_plan_breakfast_lunch_dinner_cost" class="form-label">Meal Plan (Breakfast + lunch/dinner) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="meal_plan_breakfast_lunch_dinner_cost" value="" required>
                                        @error('meal_plan_breakfast_lunch_dinner_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                 <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="meal_plan_all_meals_cost" class="form-label">Meal Plan (All meals) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="meal_plan_all_meals_cost" value="" required>
                                        @error('meal_plan_all_meals_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="hatchback_cost" class="form-label">Vehicle (Hatchback) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="hatchback_cost" value="" required>
                                        @error('hatchback_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                 <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="sedan_cost" class="form-label">Vehicle (Sedan) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="sedan_cost" value="" required>
                                        @error('sedan_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="economy_suv_cost" class="form-label">Vehicle (Economy SUV) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="economy_suv_cost" value="" required>
                                        @error('economy_suv_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                 <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="luxury_suv_cost" class="form-label">Vehicle (Luxury SUV) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="luxury_suv_cost" value="" required>
                                        @error('luxury_suv_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="traveller_mini_cost" class="form-label">Vehicle (Traveller (7-12 pass)) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="traveller_mini_cost" value="" required>
                                        @error('traveller_mini_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                 <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="traveller_big_cost" class="form-label">Vehicle (Traveller (12-21 pass)) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="traveller_big_cost" value="" required>
                                        @error('traveller_big_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="premium_traveller_cost" class="form-label">Vehicle (Premium traveller (10-16 pass)) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="premium_traveller_cost" value="" required>
                                        @error('premium_traveller_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                
                                 <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="ac_coach_cost" class="form-label">Vehicle (AC Coach (18-30 pass)) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="ac_coach_cost" value="" required>
                                        @error('ac_coach_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
{{-- 
                                </div>
                                
                                 <div class="form-group row"> --}}
                                    <div class="col-sm-6">
                                        <label for="extra_bed_cost" class="form-label">Extra Bed Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="extra_bed_cost" value="" required>
                                        @error('extra_bed_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            


                                    <!-- More fields here... -->
                            
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