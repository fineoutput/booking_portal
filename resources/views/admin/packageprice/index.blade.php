@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Package Price</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Package Price</a></li>
            <li class="breadcrumb-item active">View Package Price</li>
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
              <div class="row">
                <div class="col-md-8">
                  <h4 class="mt-0 header-title">View Package Price List</h4>
                </div>
                <div class="col-md-2"> <a class="btn btn-info cticket" href="{{ route('package_price_create', $package_id->id) }}" role="button" style="margin-left: 20px;"> Add Price</a></div>
                <div class="col-md-2"> <a class="btn btn-info cticket" href="{{ route('vehicle_cost', $package_id->id) }}" role="button" style="margin-left: 20px;"> Add Vehicle Price</a></div>
                <div class="col-md-2"> <a class="btn btn-info cticket" href="{{ route('location_cost', $package_id->id) }}" role="button" style="margin-left: 20px;"> Add Location</a></div>
              </div>
              <hr style="margin-bottom: 50px;background-color: darkgrey;">
              <div class="table-rep-plugin">
                <div class="table-responsive b-0" data-pattern="priority-columns">
                  <table id="userTable" class="table  table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th data-priority="1">Package Name</th>
                        <th data-priority="1">Start Month</th>
                        <th data-priority="1">End Month</th>
                        <th data-priority="3">Hotel Category </th>
                        <th data-priority="3"> Room Category</th>
                        <th data-priority="3"> Room Cost</th>
                        <th data-priority="3">Child With Bed Cost</th>
                        <th data-priority="3">Child With No Bed (Infant) Cost</th>
                        <th data-priority="3">Meal Plan Breakfast Cost</th>
                        <th data-priority="3">Meal Plan (Breakfast + Lunch/Dinner) Cost</th>
                        <th data-priority="3">Meal Plan (All Meal) Cost</th>
                        <th data-priority="3">Hatchback Cost</th>
                        <th data-priority="3">Sedan Cost</th>
                        <th data-priority="3">Economy SUV Cost</th>
                        <th data-priority="3">Premium SUV Cost</th>
                        <th data-priority="3">Tempo Traveller(8-16 Seat) Cost</th>
                        <th data-priority="3">Tempo Traveller(17-25 Seat) Cost</th>
                        <th data-priority="3">Urbania(12-17 Seat) Cost</th>
                        <th data-priority="3">Luxury Bus Cost</th>
                        <th data-priority="3">Deluxe Bus Cost </th>
                        <th data-priority="3">Extra Bed Cost</th>
                        <th data-priority="3">Display Cost</th>
                        <th data-priority="3">Admin Margin</th>
                        <th data-priority="3">Extra Bed + Meal Plan (All meals) Cost</th>
                        <th data-priority="3">Extra Bed + Meal Plan (Breakfast) Cost</th>
                        <th data-priority="3">Extra Bed + Meal Plan (Breakfast + lunch/dinner) Cost</th>
                        <th data-priority="3">Child With No Bed + Meal Plan (All meals) Cost</th>
                        <th data-priority="3">Child With No Bed + Meal Plan (Breakfast) Cost</th>
                        <th data-priority="3">Child With No Bed + Meal Plan (Breakfast + lunch/dinner) Cost</th>
                        
                        <th data-priority="6">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($package as $key=> $pkg)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{ $pkg->package->package_name ?? '' }}</td>
                                <td>{{ $pkg->start_date ?? '' }}</td>
                                <td>{{ $pkg->end_date ?? '' }}</td>
                              <td>
                                @if ($pkg->hotel_category == 'standard_cost')
                                    Standard Hotel
                                @elseif ($pkg->hotel_category == 'deluxe_cost')
                                    Deluxe Hotel
                                @elseif ($pkg->hotel_category == 'premium_3_cost')
                                    Premium (3 star)
                                @elseif ($pkg->hotel_category == 'super_deluxe_cost')
                                    Super Deluxe Hotel
                                @elseif ($pkg->hotel_category == 'premium_cost')
                                    Premium (4 star)
                                @elseif ($pkg->hotel_category == 'luxury_cost')
                                    Deluxe (4 star) Hotel
                                @elseif ($pkg->hotel_category == 'premium_5_cost')
                                    Premium (5 star)
                                @elseif ($pkg->hotel_category == 'hostels')
                                    Hostels
                                @else
                                    NO DATA
                                @endif
                            </td>
                                <td>{{ $pkg->room_category ?? '0' }}</td>
                                <td>₹{{ $pkg->room_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->child_with_bed_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->child_no_bed_infant_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->meal_plan_breakfast_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->meal_plan_breakfast_lunch_dinner_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->meal_plan_all_meals_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->hatchback_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->sedan_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->economy_suv_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->luxury_suv_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->traveller_mini_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->traveller_big_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->premium_traveller_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->ac_coach_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->bus_nonac_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->extra_bed_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->display_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->admin_margin ?? '0' }}</td>

                                <td>₹{{ $pkg->extra_all_meals_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->extra_breakfast_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->extra_breakfast_lunch_dinner_cost ?? '0' }}</td>

                                <td>₹{{ $pkg->child_all_meals_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->child_breakfast_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->child_breakfast_lunch_dinner_cost ?? '0' }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <a href="{{ route('package_price.edit', $pkg->id) }}" class="btn btn-warning">Edit</a>
                                    
                                    <!-- Delete Form -->
                                    <form action="{{ route('package_price.destroy', $pkg->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE') <!-- This generates a DELETE request -->
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this package?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- end col -->
      </div> <!-- end row -->
    </div>
    <!-- end page content-->
  </div> <!-- container-fluid -->
</div> <!-- content -->

@endsection