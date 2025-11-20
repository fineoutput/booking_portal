@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View {{$package_id->title ?? ''}} Price</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">{{$package_id->title ?? ''}} Price</a></li>
            <li class="breadcrumb-item active">View {{$package_id->title ?? ''}} Price</li>
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
                  <h4 class="mt-0 header-title">View {{$package_id->title ?? ''}} Price List</h4>
                </div>
                <div class="col-md-2"> <a class="btn btn-info cticket" href="{{ route('hotels_room', $package_id->hotel_id) }}" role="button" style="margin-left: 20px;">Back</a></div>
                <div class="col-md-2"> <a class="btn btn-info cticket" href="{{ route('hotel_price_create', $package_id->id) }}" role="button" style="margin-left: 20px;"> Add {{$package_id->title ?? ''}} Price</a></div>
              </div>
              <hr style="margin-bottom: 50px;background-color: darkgrey;">
              <div class="table-rep-plugin">
                <div class="table-responsive b-0" data-pattern="priority-columns">
                  <table id="userTable" class="table  table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th data-priority="1">Hotel Name</th>
                        <th data-priority="1">Room</th>
                        <th data-priority="1">Start Month</th>
                        <th data-priority="1">End Month</th>
                        <th data-priority="3">Night Cost</th>
                        <th data-priority="3">MRP</th>
                        {{-- <th data-priority="3">Room Category</th> --}}
                        {{-- <th data-priority="3">Room Cost</th> --}}
                        <th data-priority="3">Meal Plan (Breakfast) Cost</th>
                        <th data-priority="3">Meal Plan (Breakfast + lunch/dinner) Cost</th>
                        <th data-priority="3">Meal Plan (All meals) Cost</th>
                        <th data-priority="3">Extra Bed + Meal Plan (All meals) Cost</th>
                        <th data-priority="3">Extra Bed + Meal Plan (Breakfast) Cost</th>
                        <th data-priority="3">Extra Bed + Meal Plan (Breakfast + lunch/dinner) Cost</th>
                        <th data-priority="3">Extra Bed Adult Cost </th>
                        <th data-priority="3">Child With No Bed + Meal Plan (All meals) Cost </th>
                        <th data-priority="3">Child With No Bed + Meal Plan (Breakfast) Cost </th>
                        <th data-priority="3">Child With No Bed + Meal Plan (Breakfast + lunch/dinner) Cost </th>
                        <th data-priority="3">Child With No Bed Cost </th>
                        <th data-priority="6">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($package as $key=> $pkg)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{ $pkg->hotel->name ?? '' }}</td>
                                <td>{{ $pkg->room->title ?? '' }}</td>
                                <td>{{ \Carbon\Carbon::parse($pkg->start_date)->format('d F Y') ?? '' }}</td>
                                <td>{{ \Carbon\Carbon::parse($pkg->end_date)->format('d F Y') ?? '' }}</td>
                                {{-- <td>{{ $pkg->end_date ?? '' }}</td> --}}
                                <td>₹{{ $pkg->night_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->mrp ?? '0' }}</td>
                                {{-- <td>{{ $pkg->room_category ?? '' }}</td> --}}
                                {{-- <td>₹{{ $pkg->room_cost ?? '0' }}</td> --}}
                                <td>₹{{ $pkg->meal_plan_breakfast_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->meal_plan_breakfast_lunch_dinner_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->meal_plan_all_meals_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->extra_all_meals_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->extra_breakfast_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->extra_breakfast_lunch_dinner_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->extra_bed_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->child_all_meals_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->child_breakfast_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->child_breakfast_lunch_dinner_cost ?? '0' }}</td>
                                <td>₹{{ $pkg->child_no_bed_infant_cost ?? '0' }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <a href="{{ route('hotel_price.edit', $pkg->id) }}" class="btn btn-warning">Edit</a>
                                    
                                    <!-- Delete Form -->
                                    <form action="{{ route('hotel_price.destroy', $pkg->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE') <!-- This generates a DELETE request -->
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Hotel Price?')">Delete</button>
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