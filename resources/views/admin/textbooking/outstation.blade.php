@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Taxi Booking</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Taxi Booking</a></li>
            <li class="breadcrumb-item active">View Taxi Booking</li>
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
                  <h4 class="mt-0 header-title">View Taxi Booking List</h4>
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
                        <th data-priority="1">User Name</th>
                        <th data-priority="1">Salesman Name</th>
                        <th data-priority="1">Salesman Mobile	</th>
                        <th data-priority="1">Trip Type</th>
                        <th data-priority="3">Destination City</th>
                        <th data-priority="3">Vehicle</th>
                        <th data-priority="3">Pickup Date</th>
                        <th data-priority="3">Departure Location</th>
                        <th data-priority="3">Destination Location</th>
                        {{-- <th data-priority="3">Pickup Date For Round Trip</th> --}}
                        <th data-priority="3">Return Date</th>

                        <th data-priority="3">Agent Margin</th>
                        <th data-priority="3">Final Cost</th>
                        <th data-priority="3">Per KM Charge</th>
                        <th data-priority="3">Action</th>

                      </tr>
                    </thead>
                   <tbody>
                        @foreach($agent as $key=> $value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$value->user->name ?? ''}}</td>
                                <td>{{$value->salesman_name ?? ''}}</td>
                                <td>{{$value->salesman_mobile	 ?? ''}}</td>
                                <td>{{$value->taxi_se->trip_type ?? ''}}</td>
                                <td>{{$value->taxi_se->routes->from_destination ?? ''}}-{{$value->taxi_se->routes->to_destination ?? ''}}</td>

                                <td>
                                    @if($value->taxi_se->trip_type == 'one-way')
                                    {{$value->taxi_se->vehicle->vehicle_type ?? ''}}
                                    @else
                                    {{$value->taxi_se->vehicle_1->vehicle_type ?? ''}}
                                    @endif
                                </td>

                                <td>
                                    @if($value->taxi_se->trip_type == 'one-way')
                                    {{$value->taxi_se->pickup_date ?? ''}}
                                    @else
                                    {{$value->taxi_se->pickup_date_1 ?? ''}}
                                    @endif
                                </td>

                                <td>{{$value->taxi_se->departure_location ?? ''}}</td>
                                <td>{{$value->taxi_se->destination_location ?? ''}}</td>
                                <td>{{$value->taxi_se->drop_date ?? ''}}</td>

                                <td>₹{{$value->agent_margin ?? '₹0'}}</td>
                                <td>₹{{$value->final_price ?? '₹0'}}</td>
                                <td>₹{{$value->taxi_se->vehicle_1->roundtrip->per_km_charge ?? '0'}}</td>
                              <td>
                                <form action="{{ route('taxi.updateStatus', $value->id) }}" method="POST" style="display:inline;">
                                  @csrf
                                  @method('PUT') <!-- Change from PUT to PATCH -->
                              
                                  <!-- Show "Complete" or "Cancel" buttons based on the current status -->
                                  @if($value->status == 0)
                                      <!-- Pending, show Complete and Cancel buttons -->
                                      <button type="submit" class="btn btn-info" 
                                              name="status_action" value="accept" 
                                              onclick="return confirm('Are you sure you want to change the status to Complete?')">
                                              Accept
                                      </button>
                                      {{-- <button type="submit" class="btn btn-info" 
                                              name="status_action" value="complete" 
                                              onclick="return confirm('Are you sure you want to change the status to Complete?')">
                                          Complete
                                      </button> --}}
                              
                                      <button type="submit" class="btn btn-danger" 
                                              name="status_action" value="cancel" 
                                              onclick="return confirm('Are you sure you want to cancel this booking?')">
                                          Reject
                                      </button>
                                  @elseif($value->status == 3)

                                  <button type="submit" class="btn btn-info" 
                                              name="status_action" value="complete" 
                                              onclick="return confirm('Are you sure you want to change the status to Complete?')">
                                          Complete
                                      </button>
                              
                                      <button type="submit" class="btn btn-danger" 
                                              name="status_action" value="cancel" 
                                              onclick="return confirm('Are you sure you want to cancel this booking?')">
                                          Reject
                                      </button>

                                  @elseif($value->status == 1)
                                  <p class="text-success">Completed</p>
                                      <!-- Confirmed, show Cancel button -->
                                      {{-- <button type="submit" class="btn btn-danger mt-3" 
                                              name="status_action" value="cancel" 
                                              onclick="return confirm('Are you sure you want to cancel this booking?')">
                                          Cancel
                                      </button> --}}
                                  @else
                                  @if($value->status == 1)
                                      <p class="text-success">Completed</p>
                                      @elseif($hotel->status == 3)
                                      <p class="text-success">Accepted</p>
                                      @else
                                      <p class="text-danger">Rejected</p>
                                      @endif
                                  @endif
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