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
                        {{-- <th data-priority="3">Hotel Category Cost</th> --}}
                        <th data-priority="3"> Room Category</th>
                        {{-- <th data-priority="3"> Hotel Delux Cost</th> --}}
                        <th data-priority="3"> Room Cost</th>
                        {{-- <th data-priority="3">Premium 5 star Cost</th>
                        <th data-priority="3">Premium 3 star Cost</th>
                        <th data-priority="3">Deluxe 3 Cost</th>
                        <th data-priority="3">Deluxe 4 Cost</th>
                        <th data-priority="3">Deluxe 5 Cost</th> --}}
                        {{-- <th data-priority="3">Nights Cost</th> --}}
                        {{-- <th data-priority="3">Adults Cost</th> --}}
                        <th data-priority="3">Child With Bed Cost</th>
                        <th data-priority="3">Child With No Bed (Infant) Cost</th>
                        <th data-priority="3">Children (1-5 years) Cost</th>
                        <th data-priority="3">Children (5-11 years) Cost</th>
                        {{-- <th data-priority="3">Meal Plan (Only Room) Cost</th> --}}
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
                        {{-- <th data-priority="3">Luxury (Sedan) Cost</th>
                        <th data-priority="3">SUV Cost</th> --}}
                        {{-- <th data-priority="3">MUV Cost</th> --}}
                        <th data-priority="3">Deluxe Bus Cost </th>
                        <th data-priority="3">Extra Bed Cost</th>
                        <th data-priority="3">Display Cost</th>
                        <th data-priority="3">Admin Margin</th>
                        
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
                                {{-- <td>₹{{ $pkg->category_cost ?? '0' }}</td> --}}
                                <td>{{ $pkg->room_category ?? '0' }}</td>
                                {{-- <td>₹{{ $pkg->hotel_delux_cost ?? '0' }}</td> --}}
                                <td>₹{{ $pkg->room_cost ?? '0' }}</td>
                                {{-- <td>₹{{ $pkg->premium_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->premium_3_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->deluxe_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->super_deluxe_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->luxury_cost ?? '0' }}</td> --}}
                                {{-- <td>₹{{ $pkg->nights_cost ?? '0' }}</td> --}}
                                {{-- <td>₹{{ $pkg->adults_cost ?? '0' }}</td> --}}
                                <td>₹{{ $pkg->child_with_bed_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->child_no_bed_infant_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->children_1_5_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->children_5_11_cost ?? '0' }}</td>
                                {{-- <td>₹{{ $pkg->meal_plan_only_room_cost ?? '0' }}</td> --}}
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
                                {{-- <td>₹{{ $pkg->luxury_sedan_cost ?? '0' }}</td> --}}
                                {{-- <td>₹{{ $pkg->suv_cost ?? '0' }}</td> --}}
                                {{-- <td>₹{{ $pkg->muv_cost ?? '0' }}</td> --}}
                                <td>₹{{ $pkg->bus_nonac_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->extra_bed_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->display_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->admin_margin ?? '0' }}</td>
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