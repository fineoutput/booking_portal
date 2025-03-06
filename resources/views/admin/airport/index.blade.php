@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Airport Locations</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Airport Locations</a></li>
            <li class="breadcrumb-item active">View Airport Locations</li>
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
                  <h4 class="mt-0 header-title">View Airport Locations</h4>
                </div>
                <div class="col-md-2"> <a class="btn btn-info cticket" href="{{route('airport_create')}}" role="button" style="margin-left: 20px;"> Add Airport</a></div>
              </div>
              <hr style="margin-bottom: 50px;background-color: darkgrey;">
              <div class="table-rep-plugin">
                <div class="table-responsive b-0" data-pattern="priority-columns">
                  <table id="userTable" class="table  table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th data-priority="1">airport</th>
                        <th data-priority="1">City</th>
                        <th data-priority="1">Vehicle</th>
                        <th data-priority="1">description</th>
                        <th data-priority="1">Action</th>
                      </tr>
                    </thead>
                   <tbody>
                    @foreach($WildlifeSafari as $key=> $hotel)
                    <tr>
                        <td>{{ $key+1 }}</td> <!-- Loop index -->
                        <td>{{ $hotel->airport ?? '' }}</td>
                        <td>{{ $hotel->city->city_name ?? '' }}</td>
                        <td>
    @php
        $vehicleIds = explode(',', $hotel->vehicle_id);
        $vehicleNames = \App\Models\Vehicle::whereIn('id', $vehicleIds)->pluck('vehicle_type')->toArray();
        echo implode(', ', $vehicleNames);
    @endphp
</td>

                        <td>{!!  $hotel->description  !!}</td>
                        <!-- <td>{{ $hotel->local_guide ?? '' }}</td>
                        <td>{{ $hotel->out_station_guide ?? '' }}</td>
                        <td>{{ $hotel->cost ?? '' }}</td> -->
                        {{-- <td>{{ $hotel->vehicle ?? '' }}</td> --}}

                        <td>
                            <a href="{{ route('airport.edit', $hotel->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('airport.destroy', $hotel->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Safari?')">Delete</button>
                            </form>
                            <a href="{{ route('vehicleprice', $hotel->id) }}" class="btn btn-primary">
                              Add Price
                          </a>
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