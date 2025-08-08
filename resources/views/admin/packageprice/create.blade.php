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
              @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
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
                                        <input type="date" class="form-control" name="start_date" value="" required>
                                        @error('start_date')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="end_date" class="form-label">End Month &nbsp;<span style="color:red;">*</span></label>
                                        <input type="date" class="form-control" name="end_date" value="" required>
                                        @error('end_date')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group row mt-5"> 
                                              <div class="col-sm-6">
                                        <select class="form-control" name="hotel_category" id="hotel_category" required>
                                            <option selected disabled value="">Select Hotel Category</option>
                                            <option value="standard_cost">Standard Hotel</option>
                                            <option value="deluxe_cost">Deluxe Hotel</option>
                                            <option value="super_deluxe_cost">Super Deluxe Hotel</option>
                                            <option value="luxury_cost">Deluxe (4 star) Hotel</option>
                                            {{-- <option value="premium_3_cost">Premium (3 star)</option>
                                            <option value="premium_cost">Premium (4 star)</option>
                                            <option value="premium_5_cost">Premium (5 star)</option>
                                            <option value="hostels">Hostels</option> --}}
                                        </select>
                                        <div class="form-floating">
                                            @error('hotel_category')
                                            <div style="color:red">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        {{-- <label for="room_category" class="form-label">Select Room Category &nbsp;<span style="color:red;">*</span></label> --}}
                                        <select class="form-control" name="room_category" id="room_category" required>
                                            <option selected disabled value="">Select Room Category</option>
                                            <option value="premium">Premium</option>
                                            <option value="deluxe">Deluxe</option>
                                        </select>
                                        @error('room_category')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    </div>

                                     <div class="form-group row">
                                          {{-- <div class="col-sm-6">
                                        <label for="hotel_delux_cost" class="form-label">Hotel Delux Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="hotel_delux_cost" value="" required>
                                        @error('hotel_delux_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="hotel_premium_cost" class="form-label">Hotel Premium Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="hotel_premium_cost" value="" required>
                                        @error('hotel_premium_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                                    

                                    <div class="col-sm-6">
                                        <label for="room_cost" class="form-label">Room Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="room_cost" value="" required>
                                        @error('room_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    </div>

                                 

                                    {{-- <div class="col-sm-6">
                                        <label for="standard_cost" class="form-label">Standard (1 star) Hotel category Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="standard_cost" value="" required>
                                        @error('standard_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <div class="col-sm-6">
                                        <label for="deluxe_cost" class="form-label">Deluxe (3 star) Hotel category Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="deluxe_cost" value="" required>
                                        @error('deluxe_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>



                                    </div>
                                    <div class="form-group row"> 
                            
                                    <div class="col-sm-6">
                                        <label for="super_deluxe_cost" class="form-label">Deluxe (4 star) Hotel categoryCost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="super_deluxe_cost" value="" required>
                                        @error('super_deluxe_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <div class="col-sm-6">
                                        <label for="luxury_cost" class="form-label">Deluxe (5 star) Hotel category Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="luxury_cost" value="" required>
                                        @error('luxury_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    </div>

                                    <div class="form-group row"> 
                                          
                                        <div class="col-sm-6">
                                            <label for="premium_3_cost" class="form-label">Premium (3 star) Hotel category Cost &nbsp;<span style="color:red;">*</span></label>
                                            <input type="number" class="form-control" name="premium_3_cost" value="" required>
                                            @error('premium_3_cost')
                                                <div style="color:red;">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    <div class="col-sm-6">
                                        <label for="premium_cost" class="form-label">Premium (4 star) Hotel category Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="premium_cost" value="" required>
                                        @error('premium_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                                    
                                    </div>
                                    <div class="form-group row"> 
{{--                             
                                    <div class="col-sm-6">
                                        <label for="nights_cost" class="form-label">Hotel Per Night Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="nights_cost" value="" required>
                                        @error('nights_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                            
                                    {{-- <div class="col-sm-6">
                                        <label for="adults_cost" class="form-label">Adults Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="adults_cost" value="" required>
                                        @error('adults_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                                    </div>
                                    {{-- <div class="form-group row">  --}}
                            
                                    {{-- <div class="col-sm-6">
                                        <label for="child_with_bed_cost" class="form-label">Child With Bed Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="child_with_bed_cost" value="" required>
                                        @error('child_with_bed_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                             --}}
                                   
                                    {{-- </div> --}}
                            
                                 <div class="form-group row">
                                    {{-- <div class="col-sm-6">
                                        <label for="child_no_bed_child_cost" class="form-label">Child With No Bed (Child) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="child_no_bed_child_cost" value="" required>
                                        @error('child_no_bed_child_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div> --}}

                                    {{-- <div class="col-sm-6">
                                        <label for="children_5_11_cost" class="form-label">Children (5-11 years) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="children_5_11_cost" value="" required>
                                        @error('children_5_11_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="children_1_5_cost" class="form-label">Children (1-5 years) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="children_1_5_cost" value="" required>
                                        @error('children_1_5_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div> --}}

                                    {{-- <div class="col-sm-6">
                                        <label for="meal_plan_only_room_cost" class="form-label">Meal Plan (Only Room) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="meal_plan_only_room_cost" value="" required>
                                        @error('meal_plan_only_room_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div> --}}

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
                                    
                                    {{-- <div class="col-sm-6"> --}}
                                        {{-- <label for="hatchback_cost" class="form-label">Hatchback Cost &nbsp;<span style="color:red;">*</span></label> --}}
                                        <input type="hidden" class="form-control" name="hatchback_cost" value="{{$vehicleprice->hatchback_cost ?? 0}}" readonly required>

                                        <input type="hidden" class="form-control" name="sedan_cost" value="{{$vehicleprice->sedan_cost ?? 0}}" readonly required>

                                         <input type="hidden" class="form-control" name="economy_suv_cost" value="{{$vehicleprice->economy_suv_cost ?? 0}}" readonly required>

                                          <input type="hidden" class="form-control" name="luxury_suv_cost" value="{{$vehicleprice->luxury_suv_cost ?? 0}}" readonly required>

                                          <input type="hidden" class="form-control" name="traveller_mini_cost" value="{{$vehicleprice->traveller_mini_cost ?? 0}}" readonly required>

                                           <input type="hidden" class="form-control" name="traveller_big_cost" value="{{$vehicleprice->traveller_big_cost ?? 0}}" readonly required>

                                            <input type="hidden" class="form-control" name="premium_traveller_cost" value="{{$vehicleprice->premium_traveller_cost ?? 0}}" readonly required>

                                            <input type="hidden" class="form-control" name="bus_nonac_cost" value="{{$vehicleprice->bus_nonac_cost ?? 0}}" readonly required>

                                            <input type="hidden" class="form-control" name="ac_coach_cost" value="{{$vehicleprice->ac_coach_cost ?? 0}}" readonly required>

                                        {{-- @error('hatchback_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div> --}}

                                </div>

                                
                                <div class="form-group row mt-5">

                                    <div class="col-sm-6">
                                        <label for="extra_all_meals_cost" class="form-label">Extra Bed + Meal Plan (All meals) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="extra_all_meals_cost" value="" required>
                                        @error('extra_all_meals_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-sm-6">
                                        <label for="extra_breakfast_cost" class="form-label">Extra Bed + Meal Plan (Breakfast) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="extra_breakfast_cost" value="" required>
                                        @error('extra_breakfast_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="extra_breakfast_lunch_dinner_cost" class="form-label">Extra Bed + Meal Plan (Breakfast + lunch/dinner) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="extra_breakfast_lunch_dinner_cost" value="" required>
                                        @error('extra_breakfast_lunch_dinner_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                     <div class="col-sm-6">
                                        <label for="extra_bed_cost" class="form-label">Extra Bed Adult Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="extra_bed_cost" value="" required>
                                        @error('extra_bed_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>


                                </div>


                                <div class="form-group row mt-5">

                                    <div class="col-sm-6">
                                        <label for="child_all_meals_cost" class="form-label">Child With No Bed + Meal Plan (All meals) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="child_all_meals_cost" value="" required>
                                        @error('child_all_meals_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-sm-6">
                                        <label for="child_breakfast_cost" class="form-label">Child With No Bed + Meal Plan (Breakfast) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="child_breakfast_cost" value="" required>
                                        @error('child_breakfast_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="child_breakfast_lunch_dinner_cost" class="form-label">Child With No Bed + Meal Plan (Breakfast + lunch/dinner) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="child_breakfast_lunch_dinner_cost" value="" required>
                                        @error('child_breakfast_lunch_dinner_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                     <div class="col-sm-6">
                                        <label for="child_no_bed_infant_cost" class="form-label">Child With No Bed Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="child_no_bed_infant_cost" value="" required>
                                        @error('child_no_bed_infant_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>


                                </div>


                                 <div class="form-group row mt-5">

                                   
                                    
                                    <div class="col-sm-6">
                                        <label for="display_cost" class="form-label">Display Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="display_cost" value="" required>
                                        @error('display_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="admin_margin" class="form-label">Admin Margin &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="admin_margin" value="" required>
                                        @error('admin_margin')
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