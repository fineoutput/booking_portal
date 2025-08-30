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
                            <form action="{{ route('hotel_price_create', $package->id ?? '') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">                            
                                    <!-- Multiple Costs -->

                                    <div class="col-sm-6">
                                        <label for="start_date" class="form-label">Start Month &nbsp;<span style="color:red;">*</span></label>
                                        <input type="date" class="form-control" name="start_date" value="" >
                                        @error('start_date')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="end_date" class="form-label">End Month &nbsp;<span style="color:red;">*</span></label>
                                        <input type="date" class="form-control" name="end_date" value="" >
                                        @error('end_date')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">     
                                    <div class="col-sm-6">
                                        <label for="night_cost" class="form-label">Hotel Night Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="night_cost" value="" >
                                        @error('night_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <select class="form-control" name="room_category" id="room_category" >
                                            <option selected disabled value="">Select Room Category</option>
                                            <option value="premium">Premium</option>
                                            <option value="deluxe">Deluxe</option>
                                        </select>
                                        @error('room_category')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 mt-4">
                                        <label for="room_cost" class="form-label">Room Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="room_cost" value="" >
                                        @error('room_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>


                                <h2 class="mt-5">Meals </h2>

                                <div class="form-group row ">
                                    <div class="col-sm-6">
                                        <label for="meal_plan_breakfast_cost" class="form-label">Meal Plan (Breakfast) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="meal_plan_breakfast_cost" value="" >
                                        @error('meal_plan_breakfast_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                </div>

                                <div class="col-sm-6">
                                        <label for="meal_plan_breakfast_lunch_dinner_cost" class="form-label">Meal Plan (Breakfast + lunch/dinner) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="meal_plan_breakfast_lunch_dinner_cost" value="" >
                                        @error('meal_plan_breakfast_lunch_dinner_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="form-group row ">
                                    <div class="col-sm-6">
                                        <label for="meal_plan_all_meals_cost" class="form-label">Meal Plan (All meals) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="meal_plan_all_meals_cost" value="" >
                                        @error('meal_plan_all_meals_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <h2 class="mt-5">Extra Bed + Meals </h2>

                                <div class="form-group row mt-5">
                                    
                                    <div class="col-sm-6">
                                        <label for="extra_all_meals_cost" class="form-label">Extra Bed + Meal Plan (All meals) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="extra_all_meals_cost" value="" >
                                        @error('extra_all_meals_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="extra_breakfast_cost" class="form-label">Extra Bed + Meal Plan (Breakfast) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="extra_breakfast_cost" value="" >
                                        @error('extra_breakfast_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="form-group row mt-5">
                                  <div class="col-sm-6">
                                        <label for="extra_breakfast_lunch_dinner_cost" class="form-label">Extra Bed + Meal Plan (Breakfast + lunch/dinner) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="extra_breakfast_lunch_dinner_cost" value="" >
                                        @error('extra_breakfast_lunch_dinner_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                     <div class="col-sm-6">
                                        <label for="extra_bed_cost" class="form-label">Extra Bed Adult Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="extra_bed_cost" value="" >
                                        @error('extra_bed_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>


                                <h2 class="mt-5">Child With No Bed + Meals </h2>

                                <div class="form-group row mt-5">

                                    <div class="col-sm-6">
                                        <label for="child_all_meals_cost" class="form-label">Child With No Bed + Meal Plan (All meals) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="child_all_meals_cost" value="" >
                                        @error('child_all_meals_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-sm-6">
                                        <label for="child_breakfast_cost" class="form-label">Child With No Bed + Meal Plan (Breakfast) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="child_breakfast_cost" value="" >
                                        @error('child_breakfast_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="form-group row mt-5">
                                    <div class="col-sm-6">
                                        <label for="child_breakfast_lunch_dinner_cost" class="form-label">Child With No Bed + Meal Plan (Breakfast + lunch/dinner) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="child_breakfast_lunch_dinner_cost" value="" >
                                        @error('child_breakfast_lunch_dinner_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                     <div class="col-sm-6">
                                        <label for="child_no_bed_infant_cost" class="form-label">Child With No Bed Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="child_no_bed_infant_cost" value="" >
                                        @error('child_no_bed_infant_cost')
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