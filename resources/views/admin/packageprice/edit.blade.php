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
                            <form action="{{ route('package_price.update', $package->id ?? '') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') <!-- Use PUT method for editing data -->
                                <div class="form-group row">
                                    <!-- Standard Cost -->

                                    <div class="col-sm-6">
                                        <label for="start_date" class="form-label">Start Month &nbsp;<span style="color:red;">*</span></label>
                                        <input type="date" class="form-control" name="start_date"
                                         value="{{ old('start_date', $package->start_date) }}" required>
                                        @error('start_date')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="end_date" class="form-label">End Month &nbsp;<span style="color:red;">*</span></label>
                                        <input type="date" class="form-control" name="end_date" 
                                        value="{{ old('end_date', $package->end_date) }}" required>
                                        @error('end_date')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group row mt-5"> 
                                        <div class="col-sm-6">
                                            <label for="hotel_category" class="form-label">Hotel Category&nbsp;<span style="color:red;">*</span></label>
                                            <select class="form-control" name="hotel_category" id="hotel_category" required>
                                                <option disabled value="">Select Hotel Category</option>
                                                <option value="standard_cost" {{ (old('hotel_category', $package->hotel_category ?? '') == 'standard_cost') ? 'selected' : '' }}>Standard Hotel</option>
                                                <option value="deluxe_cost" {{ (old('hotel_category', $package->hotel_category ?? '') == 'deluxe_cost') ? 'selected' : '' }}>Deluxe Hotel</option>

                                                <option value="super_deluxe_cost" {{ (old('hotel_category', $package->hotel_category ?? '') == 'super_deluxe_cost') ? 'selected' : '' }}>Super Deluxe Hotel</option>
                                                
                                                 <option value="luxury_cost" {{ (old('hotel_category', $package->hotel_category ?? '') == 'luxury_cost') ? 'selected' : '' }}>Deluxe (4 star) Hotel</option>

                                                   {{-- <option value="premium_3_cost" {{ (old('hotel_category', $package->hotel_category ?? '') == 'premium_3_cost') ? 'selected' : '' }}>Premium (3 star)</option>

                                                <option value="premium_cost" {{ (old('hotel_category', $package->hotel_category ?? '') == 'premium_cost') ? 'selected' : '' }}>Premium (4 star)</option>

                                                <option value="premium_5_cost" {{ (old('hotel_category', $package->hotel_category ?? '') == 'premium_5_cost') ? 'selected' : '' }}>Premium (5 star)</option>

                                                <option value="hostels" {{ (old('hotel_category', $package->hotel_category ?? '') == 'hostels') ? 'selected' : '' }}>Hostels</option> --}}
                                               
                                            </select>
                                            <div class="form-floating">
                                                @error('hotel_category')
                                                    <div style="color:red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            {{-- <label for="room_category" class="form-label">Room Category&nbsp;<span style="color:red;">*</span></label> --}}
                                            <select class="form-control" name="room_category" id="room_category" required>
                                                <option disabled value="">Select Room Category</option>

                                                <option value="premium" {{ (old('room_category', $package->room_category ?? '') == 'premium') ? 'selected' : '' }}>premium</option>

                                                <option value="deluxe" {{ (old('room_category', $package->room_category ?? '') == 'deluxe') ? 'selected' : '' }}>Deluxe</option>
                                               
                                            </select>
                                            <div class="form-floating">
                                                @error('room_category')
                                                    <div style="color:red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- <div class="col-sm-6">
                                            <label for="category_cost" class="form-label">Hotel Per Night Cost&nbsp;<span style="color:red;">*</span></label>
                                            <input type="number" class="form-control" name="category_cost" id="category_cost"
                                                value="{{ old('category_cost', $package->category_cost ?? '') }}" required>
                                            @error('category_cost')
                                                <div style="color:red;">{{ $message }}</div>
                                            @enderror
                                        </div> --}}
                                    </div>

                                    <div class="form-group row">
                                         
                                        {{-- <div class="col-sm-6">
                                            <label for="hotel_delux_cost" class="form-label">Hotel Delux Cost&nbsp;<span style="color:red;">*</span></label>
                                            <input type="number" class="form-control" name="hotel_delux_cost" id="hotel_delux_cost"
                                                value="{{ old('hotel_delux_cost', $package->hotel_delux_cost ?? '') }}" required>
                                            @error('hotel_delux_cost')
                                                <div style="color:red;">{{ $message }}</div>
                                            @enderror
                                        </div>

                                   
                                        <div class="col-sm-6">
                                            <label for="hotel_premium_cost" class="form-label">Hotel Premium Cost&nbsp;<span style="color:red;">*</span></label>
                                            <input type="number" class="form-control" name="hotel_premium_cost" id="hotel_premium_cost"
                                                value="{{ old('hotel_premium_cost', $package->hotel_premium_cost ?? '') }}" required>
                                            @error('hotel_premium_cost')
                                                <div style="color:red;">{{ $message }}</div>
                                            @enderror
                                        </div> --}}

                                        <div class="col-sm-6">
                                            <label for="room_cost" class="form-label">Room Cost&nbsp;<span style="color:red;">*</span></label>
                                            <input type="number" class="form-control" name="room_cost" id="room_cost"
                                                value="{{ old('room_cost', $package->room_cost ?? '') }}" required>
                                            @error('room_cost')
                                                <div style="color:red;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    
                                    </div>


                                    {{-- <div class="col-sm-6">
                                        <label for="standard_cost" class="form-label">Standard (1 star) Hotel category Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="standard_cost" value="{{ old('standard_cost', $package->standard_cost) }}" required>
                                        @error('standard_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <!-- Deluxe Cost -->
                                    <div class="col-sm-6">
                                        <label for="deluxe_cost" class="form-label">Deluxe (3 star) Hotel category Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="deluxe_cost" value="{{ old('deluxe_cost', $package->deluxe_cost) }}" required>
                                        @error('deluxe_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <!-- Super Deluxe Cost -->
                                    <div class="col-sm-6">
                                        <label for="super_deluxe_cost" class="form-label"> Deluxe (4 star) Hotel category Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="super_deluxe_cost" value="{{ old('super_deluxe_cost', $package->super_deluxe_cost) }}" required>
                                        @error('super_deluxe_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <!-- Luxury Cost -->
                                    <div class="col-sm-6">
                                        <label for="luxury_cost" class="form-label">Deluxe (5 star) Hotel category Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="luxury_cost" value="{{ old('luxury_cost', $package->luxury_cost) }}" required>
                                        @error('luxury_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <!-- Premium Cost -->
                                    <div class="col-sm-6">
                                        <label for="premium_3_cost" class="form-label">Premium (3 star) Hotel category Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="premium_3_cost" value="{{ old('premium_3_cost', $package->premium_3_cost) }}" required>
                                        @error('premium_3_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="premium_cost" class="form-label">Premium (4 star) Hotel category Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="premium_cost" value="{{ old('premium_cost', $package->premium_cost) }}" required>
                                        @error('premium_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                                </div>
                            
                                <div class="form-group row">
                                    <!-- Per Night Cost -->
                                    {{-- <div class="col-sm-6">
                                        <label for="nights_cost" class="form-label">Hotel Per Night Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="nights_cost" value="{{ old('nights_cost', $package->nights_cost) }}" required>
                                        @error('nights_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                            
                                    <!-- Adults Cost -->
                                    {{-- <div class="col-sm-6">
                                        <label for="adults_cost" class="form-label">Adults Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="adults_cost" value="{{ old('adults_cost', $package->adults_cost) }}" required>
                                        @error('adults_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                                </div>
                            
                                {{-- <div class="form-group row"> --}}
                                    <!-- Child With Bed Cost -->
                                    {{-- <div class="col-sm-6">
                                        <label for="child_with_bed_cost" class="form-label">Child With Bed Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="child_with_bed_cost" value="{{ old('child_with_bed_cost', $package->child_with_bed_cost) }}" required>
                                        @error('child_with_bed_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                            
                                    <!-- Child No Bed (Infant) Cost -->
                               
                                {{-- </div> --}}
                            
                                <div class="form-group row">
                                    <!-- Child No Bed (Child) Cost -->
                                    {{-- <div class="col-sm-6">
                                        <label for="child_no_bed_child_cost" class="form-label">Child With No Bed (Child) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="child_no_bed_child_cost" value="{{ old('child_no_bed_child_cost', $package->child_no_bed_child_cost) }}" required>
                                        @error('child_no_bed_child_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                                    {{-- <div class="col-sm-6">
                                        <label for="children_5_11_cost" class="form-label">Children (5-11 years) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="children_5_11_cost" value="{{ old('children_5_11_cost', $package->children_5_11_cost) }}" required>
                                        @error('children_5_11_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="children_1_5_cost" class="form-label">Children (1-5 years) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="children_1_5_cost" value="{{ old('children_1_5_cost', $package->children_1_5_cost) }}" required>
                                        @error('children_1_5_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                            
                                    <!-- Meal Plan (Only Room) Cost -->
                                    {{-- <div class="col-sm-6">
                                        <label for="meal_plan_only_room_cost" class="form-label">Meal Plan (Only Room) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="meal_plan_only_room_cost" value="{{ old('meal_plan_only_room_cost', $package->meal_plan_only_room_cost) }}" required>
                                        @error('meal_plan_only_room_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                                </div>
                            
                                <div class="form-group row">
                                    <!-- Meal Plan (Breakfast) Cost -->
                                    <div class="col-sm-6">
                                        <label for="meal_plan_breakfast_cost" class="form-label">Meal Plan (Breakfast) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="meal_plan_breakfast_cost" value="{{ old('meal_plan_breakfast_cost', $package->meal_plan_breakfast_cost) }}" required>
                                        @error('meal_plan_breakfast_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <!-- Meal Plan (Breakfast + Lunch/Dinner) Cost -->
                                    <div class="col-sm-6">
                                        <label for="meal_plan_breakfast_lunch_dinner_cost" class="form-label">Meal Plan (Breakfast + lunch/dinner) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="meal_plan_breakfast_lunch_dinner_cost" value="{{ old('meal_plan_breakfast_lunch_dinner_cost', $package->meal_plan_breakfast_lunch_dinner_cost) }}" required>
                                        @error('meal_plan_breakfast_lunch_dinner_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                       <div class="col-sm-6">
                                        <label for="meal_plan_all_meals_cost" class="form-label">Meal Plan (All meals) Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="meal_plan_all_meals_cost" value="{{ old('meal_plan_all_meals_cost', $package->meal_plan_all_meals_cost) }}" required>
                                        @error('meal_plan_all_meals_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>


                                <div class="form-group row mt-5">

                                <div class="col-sm-6">
                                    <label for="extra_all_meals_cost" class="form-label">
                                        Extra Bed + Meal Plan (All meals) Cost <span style="color:red;">*</span>
                                    </label>
                                    <input type="number" class="form-control" 
                                        name="extra_all_meals_cost" 
                                        value="{{ old('extra_all_meals_cost', $package->extra_all_meals_cost) }}" 
                                        required>
                                    @error('extra_all_meals_cost')
                                        <div style="color:red;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label for="extra_breakfast_cost" class="form-label">
                                        Extra Bed + Meal Plan (Breakfast) Cost <span style="color:red;">*</span>
                                    </label>
                                    <input type="number" class="form-control" 
                                        name="extra_breakfast_cost" 
                                        value="{{ old('extra_breakfast_cost', $package->extra_breakfast_cost) }}" 
                                        required>
                                    @error('extra_breakfast_cost')
                                        <div style="color:red;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label for="extra_breakfast_lunch_dinner_cost" class="form-label">
                                        Extra Bed + Meal Plan (Breakfast + lunch/dinner) Cost <span style="color:red;">*</span>
                                    </label>
                                    <input type="number" class="form-control" 
                                        name="extra_breakfast_lunch_dinner_cost" 
                                        value="{{ old('extra_breakfast_lunch_dinner_cost', $package->extra_breakfast_lunch_dinner_cost) }}" 
                                        required>
                                    @error('extra_breakfast_lunch_dinner_cost')
                                        <div style="color:red;">{{ $message }}</div>
                                    @enderror
                                </div>


                                   <div class="col-sm-6">
                                        <label for="extra_bed_cost" class="form-label">Extra Bed Adult Cost  &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="extra_bed_cost" value="{{ old('extra_bed_cost', $package->extra_bed_cost) }}" required>
                                        @error('extra_bed_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                

                            </div>


                                <div class="form-group row mt-5">

                                <div class="col-sm-6">
                                    <label for="child_all_meals_cost" class="form-label">
                                        Child With No Bed + Meal Plan (All meals) Cost <span style="color:red;">*</span>
                                    </label>
                                    <input type="number" class="form-control" 
                                        name="child_all_meals_cost" 
                                        value="{{ old('child_all_meals_cost', $package->child_all_meals_cost) }}" 
                                        required>
                                    @error('child_all_meals_cost')
                                        <div style="color:red;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label for="child_breakfast_cost" class="form-label">
                                        Child With No Bed + Meal Plan (Breakfast) Cost <span style="color:red;">*</span>
                                    </label>
                                    <input type="number" class="form-control" 
                                        name="child_breakfast_cost" 
                                        value="{{ old('child_breakfast_cost', $package->child_breakfast_cost) }}" 
                                        required>
                                    @error('child_breakfast_cost')
                                        <div style="color:red;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label for="child_breakfast_lunch_dinner_cost" class="form-label">
                                        Child With No Bed + Meal Plan (Breakfast + lunch/dinner) Cost <span style="color:red;">*</span>
                                    </label>
                                    <input type="number" class="form-control" 
                                        name="child_breakfast_lunch_dinner_cost" 
                                        value="{{ old('child_breakfast_lunch_dinner_cost', $package->child_breakfast_lunch_dinner_cost) }}" 
                                        required>
                                    @error('child_breakfast_lunch_dinner_cost')
                                        <div style="color:red;">{{ $message }}</div>
                                    @enderror
                                </div>


                                     <div class="col-sm-6">
                                        <label for="child_no_bed_infant_cost" class="form-label">Child With No Bed Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="child_no_bed_infant_cost" value="{{ old('child_no_bed_infant_cost', $package->child_no_bed_infant_cost) }}" required>
                                        @error('child_no_bed_infant_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>

                            </div>


                            <div class="test">
                                <input type="hidden" class="form-control" name="hatchback_cost" value="{{$vehicleprice->hatchback_cost ?? 0}}" readonly required>

                                <input type="hidden" class="form-control" name="sedan_cost" value="{{$vehicleprice->sedan_cost ?? 0}}" readonly required>

                                <input type="hidden" class="form-control" name="economy_suv_cost" value="{{$vehicleprice->economy_suv_cost ?? 0}}" readonly required>

                                <input type="hidden" class="form-control" name="luxury_sedan_cost" id="luxury_sedan_cost" value="{{$vehicleprice->luxury_sedan_cost ?? 0}}" readonly required>

                                <input type="hidden" class="form-control" name="suv_cost" id="suv_cost"
                                            value="{{$vehicleprice->suv_cost ?? 0}}" readonly required>

                                <input type="hidden" class="form-control" name="luxury_suv_cost" value="{{$vehicleprice->luxury_suv_cost ?? 0}}" readonly required>

                                 <input type="hidden" class="form-control" name="traveller_mini_cost" value="{{$vehicleprice->traveller_mini_cost ?? 0}}" readonly required>

                                 <input type="hidden" class="form-control" name="traveller_big_cost" value="{{$vehicleprice->traveller_big_cost ?? 0}}" readonly required>

                                <input type="hidden" class="form-control" name="premium_traveller_cost" value="{{$vehicleprice->premium_traveller_cost ?? 0}}" readonly required>

                                <input type="hidden" class="form-control" name="bus_nonac_cost" id="bus_nonac_cost" value="{{$vehicleprice->bus_nonac_cost ?? 0}}" readonly required>

                                <input type="hidden" class="form-control" name="ac_coach_cost" value="{{$vehicleprice->ac_coach_cost ?? 0}}" readonly required>
                            </div>
               

                                <div class="form-group row">
                                    <!-- Meal Plan (All Meals) Cost -->
                                    {{-- <div class="col-sm-6">
                                        <label for="ac_coach_cost" class="form-label">Luxury Bus Cost &nbsp;<span style="color:red;">*</span></label>
                                       
                                        @error('ac_coach_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                                {{-- </div>

                                <div class="form-group row"> --}}
                                    <!-- Meal Plan (All Meals) Cost -->
                                 
                                    <div class="col-sm-6">
                                        <label for="display_cost" class="form-label">Display Cost &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="display_cost" value="{{ old('display_cost', $package->display_cost) }}" required>
                                        @error('display_cost')
                                            <div style="color:red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="admin_margin" class="form-label">Admin Margin &nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" class="form-control" name="admin_margin" value="{{ old('admin_margin', $package->admin_margin) }}" required>
                                        @error('admin_margin')
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