@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Package Booking</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Package Booking</a></li>
            <li class="breadcrumb-item active">View Package Booking</li>
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
                  <h4 class="mt-0 header-title">View Packages Booking List</h4>
                </div>
                {{-- <div class="col-md-2"> <a class="btn btn-info cticket" href="{{route('wild_life_safari_create')}}" role="button" style="margin-left: 20px;"> Add Safari</a></div> --}}
              </div>
              <hr style="margin-bottom: 50px;background-color: darkgrey;">
              <div class="table-rep-plugin">
                <div class="table-responsive b-0" data-pattern="priority-columns">
                  <table id="userTable" class="table  table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th data-priority="1">User Name</th>
                        <th data-priority="1">Package Name</th>
                        <th data-priority="1">City</th>
                        {{-- <th data-priority="1">Date</th> --}}
                        <th data-priority="1">Check In Date</th>
                        <th data-priority="1">Check Out Date</th>
                        <th data-priority="1">Salesman Name</th>
                        <th data-priority="1">Salesman Mobile</th>
                        <th data-priority="1">Agent Margin</th>
                        <th data-priority="1">Booking Price</th>
                        <th data-priority="1">Final Price</th>
                        <th data-priority="1">Date</th>
                        <th data-priority="6">Action</th>
                      </tr>
                    </thead>
                   <tbody>
                    @foreach($package as $key=> $hotel)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $hotel->user->name ?? '' }}</td>
                        <td>{{ $hotel->package->package_name ?? '' }}</td>
                        <td>{{ $hotel->package->cities->city_name ?? '' }}</td>
                        <td>{{ \Carbon\Carbon::parse($hotel->check_in_date)->format('d F Y') ?? '' }}</td>
                        <td>{{ \Carbon\Carbon::parse($hotel->check_out_date)->format('d F Y') ?? '' }}</td>
                        <td>{{ $hotel->salesman_name ?? '' }}</td>
                        <td>{{ $hotel->salesman_mobile ?? '' }}</td>
                        <td>₹{{ $hotel->agent_margin ?? '' }}</td>
                        <td>₹{{ $hotel->fetched_price ?? '' }}</td>
                        <td>₹{{ $hotel->final_price ?? '' }}</td>
                        <td>{{ \Carbon\Carbon::parse($hotel->created_at)->format('d F Y') ?? '' }}</td>
                        {{-- <td>{{ $hotel->cost ?? '' }}</td> --}}
                        {{-- <td>
                          @if($hotel->status == 0)
                          <p class="text-danger">Pending</p>
                          @else
                          
                            <p class="text-success">Complete</p>
                          @endif
                        </td> --}}
                        {{-- <td>{{ $hotel->vehicle ?? '' }}</td> --}}
 
                        <td>
                                <!-- Update Status Button -->
                                <form action="{{ route('packagebooking.updateStatus', $hotel->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH') <!-- Change from PUT to PATCH -->
                                
                                    @if($hotel->status == 0)
                                    <button type="submit" class="btn btn-info" onclick="return confirm('Are you sure you want to change the status?')" 
                                            {{ $hotel->status == 1 ? 'disabled title=Status is already Complete' : '' }}>
                                        {{ $hotel->status == 1 ? 'Complete' : 'Complete' }}
                                    </button>
                                    @else
                                    <p class="text-success">Completed</p>
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