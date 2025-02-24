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
                        <th data-priority="1">Trip Type</th>
                        <th data-priority="3">Destination City</th>
                        <th data-priority="3">Vehicle</th>
                        <th data-priority="3">Pickup Date</th>
                        <th data-priority="3">Departure Location</th>
                        <th data-priority="3">Destination Location</th>
                        {{-- <th data-priority="3">Pickup Date For Round Trip</th> --}}
                        <th data-priority="3">Return Date</th>

                        <th data-priority="3">Cost</th>
                        <th data-priority="3">Per KM Charge</th>

                      </tr>
                    </thead>
                   <tbody>
                        @foreach($agent as $key=> $value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$value->trip_type ?? ''}}</td>
                                <td>{{$value->destination_city ?? ''}}</td>

                                <td>
                                    @if($value->trip_type == 'one-way')
                                    {{$value->vehicle->vehicle_type ?? ''}}
                                    @else
                                    {{$value->vehicle_1->vehicle_type ?? ''}}
                                    @endif
                                </td>

                                <td>
                                    @if($value->trip_type == 'one-way')
                                    {{$value->pickup_date ?? ''}}
                                    @else
                                    {{$value->pickup_date_1 ?? ''}}
                                    @endif
                                </td>

                                <td>{{$value->departure_location ?? ''}}</td>
                                <td>{{$value->destination_location ?? ''}}</td>
                                <td>{{$value->drop_date ?? ''}}</td>

                                <td>{{$value->cost ?? '₹0'}}</td>
                                <td>₹{{$value->vehicle_1->roundtrip->per_km_charge ?? '0'}}</td>
                              
                                
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