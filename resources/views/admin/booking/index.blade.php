@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Booking</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Booking</a></li>
            <li class="breadcrumb-item active">View Booking</li>
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
                  <h4 class="mt-0 header-title">View Booking List</h4>
                </div>
                {{-- <div class="col-md-2"> <a class="btn btn-info cticket" href="{{route('vehicle_crete')}}" role="button" style="margin-left: 20px;"> Add Vehicle</a></div> --}}
              </div>
              <hr style="margin-bottom: 50px;background-color: darkgrey;">
              <div class="table-rep-plugin">
                <div class="table-responsive b-0" data-pattern="priority-columns">
                  <table id="userTable" class="table  table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th data-priority="1">Start Date</th>
                        <th data-priority="3">End Date</th>
                        <th data-priority="3">Adults No.</th>
                        <th data-priority="3">Kids With Bed</th>
                        <th data-priority="3">Kids Without Bed</th>
                        <th data-priority="3">Extra Bed</th>
                        <th data-priority="3">Hotel Preference</th>
                        <th data-priority="3">Room Preference</th>
                        <th data-priority="3">Meal Plan</th>
                        <th data-priority="3">Vehicle</th>
                        <th data-priority="3">Booking Source</th>
                        <th data-priority="3">Travel Insurance</th>
                        <th data-priority="3">Remarks</th>
                      </tr>
                    </thead>
                   <tbody>
                        @foreach($agent as $key=> $value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$value->start_date ?? ''}}</td>
                                <td>{{$value->end_date ?? ''}}</td>
                                <td>{{$value->adults_no ?? ''}}</td>
                                <td>{{$value->kids_with_bed ?? ''}}</td>
                                <td>{{$value->kids_without_bed ?? ''}}</td>
                                <td>{{$value->extra_bed ?? ''}}</td>
                                <td>{{$value->hotel_preference ?? ''}}</td>
                                <td>{{$value->room_preference ?? ''}}</td>
                                <td>
                                    @if($value->meal_plan == '1')
                                         <p>Only Room</p>
                                    @elseif($value->meal_plan == '2')
                                        <p>Breakfast</p>
                                    @elseif($value->meal_plan == '3')
                                        <p>Breakfast + Lunch</p>
                                    @elseif($value->meal_plan == '4')
                                         <p>Breakfast + Dinner</p>
                                    @else
                                        <p>All Meal</p>
                                    @endif
                                </td>
                                <td>{{$value->vehicle ?? ''}}</td>
                                <td>{{$value->booking_source ?? ''}}</td>
                                <td>{{$value->add_travel_insurance ?? ''}}</td>
                                <td>{{$value->special_remarks ?? ''}}</td>
                                <td>{{$value->created_at ?? ''}}</td>
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