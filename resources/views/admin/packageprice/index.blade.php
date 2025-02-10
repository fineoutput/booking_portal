@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Package</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Package</a></li>
            <li class="breadcrumb-item active">View Package</li>
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
                <div class="col-md-10">
                  <h4 class="mt-0 header-title">View Package List</h4>
                </div>
                <div class="col-md-2"> <a class="btn btn-info cticket" href="{{ route('package_price_create', $package_id->id) }}" role="button" style="margin-left: 20px;"> Add Package</a></div>
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
                        <th data-priority="3">Standard Cost</th>
                        <th data-priority="3">Premium Cost</th>
                        <th data-priority="3">Deluxe Cost</th>
                        <th data-priority="3">Super Deluxe Cost</th>
                        <th data-priority="3">Luxury Cost</th>
                        <th data-priority="3">Nights Cost</th>
                        <th data-priority="3">Adults Cost</th>
                        <th data-priority="3">Child With Bed Cost</th>
                        <th data-priority="3">Child With No Bed (Infant) Cost</th>
                        <th data-priority="3">Child With No Bed (Child) Cost</th>
                        <th data-priority="3">Meal Plan (Only Room) Cost</th>
                        <th data-priority="3">Meal Plan Breakfast Cost</th>
                        <th data-priority="3">Meal Plan (Breakfast + Lunch/Dinner) Cost</th>
                        <th data-priority="3">Meal Plan (All Meal) Cost</th>
                        <th data-priority="3">Vehicle (Hatchback) Cost</th>
                        <th data-priority="3">Vehicle (Sedan) Cost</th>
                        <th data-priority="3">Vehicle (Economy SUV) Cost</th>
                        <th data-priority="3">Vehicle (Luxury SUV) Cost</th>
                        <th data-priority="3">Vehicle (Traveller (7-12 pass)) Cost</th>
                        <th data-priority="3">Vehicle (Traveller (12-21 pass)) Cost</th>
                        <th data-priority="3">Vehicle (Premium traveller (10-16 pass)) Cost</th>
                        <th data-priority="3">Vehicle (AC Coach (18-30 pass)) Cost</th>
                        
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
                                <td>₹{{ $pkg->standard_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->premium_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->deluxe_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->super_deluxe_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->luxury_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->nights_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->adults_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->child_with_bed_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->child_no_bed_infant_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->child_no_bed_child_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->meal_plan_only_room_cost ?? '0' }}</td>
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