@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Hotel Booking</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Hotel Booking</a></li>
            <li class="breadcrumb-item active">View Hotel Booking</li>
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
                  <h4 class="mt-0 header-title">View Hotel Booking List</h4>
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
                        <th data-priority="1">Salesman Name</th>
                        <th data-priority="1">Salesman Mobile</th>
                        <th data-priority="1">Hotel Name</th>
                        <th data-priority="1">City</th>
                        {{-- <th data-priority="1">Date</th> --}}
                        <th data-priority="1">Check In Date</th>
                        <th data-priority="1">Check Out Date</th>
                        <th data-priority="1">No. Adults</th>
                        <th data-priority="1">Childrens</th>
                        <th data-priority="1">Night Count</th>
                        <th data-priority="1">Room Type</th>
                        <th data-priority="1">Child With No Bed</th>
                        <th data-priority="1">Bed</th>
                        <th data-priority="1">Meals</th>
                        <th data-priority="1">Child Age</th>
                        <th data-priority="1">Agent Cost</th>
                        <th data-priority="1">Final Cost</th>
                        <th data-priority="1">Date</th>
                        <th data-priority="1">Transfer User</th>
                        <th data-priority="6">Action</th>
                      </tr>
                    </thead>
                   <tbody>
                    @foreach($WildlifeSafari as $key=> $hotel)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $hotel->user->name ?? '' }}</td>
                        <td>{{ $hotel->salesman_name ?? '' }}</td>
                        <td>{{ $hotel->salesman_mobile ?? '' }}</td>
                        <td>{{ $hotel->hotel_se->hotel->name ?? '' }}</td>
                        <td>{{ $hotel->hotel_se->hotel->cities->city_name ?? '' }}</td>
                        <td>{{ \Carbon\Carbon::parse($hotel->hotel_se->check_in_date)->format('d F Y') ?? '' }}</td>
                        <td>{{ \Carbon\Carbon::parse($hotel->hotel_se->check_out_date)->format('d F Y') ?? '' }}</td>
                        <td>{{ $hotel->hotel_se->no_occupants ?? '' }}</td>
                        <td>{{ $hotel->hotel_se->child_count ?? '' }}</td>
                        <td>{{ $hotel->hotel_se->night_count ?? '' }}</td>
                        <td>{{ $hotel->hotel_se->room->title ?? '' }}</td>
                        <td>{{ $hotel->hotel_se->nobed ?? '' }}</td>
                        <td>{{ $hotel->hotel_se->beds ?? '' }}</td>
                        <td>{{ $hotel->hotel_se->meals ?? '' }}</td>
                        <td>{{ $hotel->hotel_se->child_count ?? '' }}Child -
                          @php
                              $childrenAges = json_decode($hotel->hotel_se->children_ages ?? '[]');
                          @endphp

                          @if(!empty($childrenAges))
                              @foreach($childrenAges as $age)
                                  {{ $age }} years @if (!$loop->last), @endif
                              @endforeach
                          @else
                              No age data available.
                          @endif
                        </td>
                        <td>{{ $hotel->agent_margin ?? '' }}</td>
                        <td>{{ $hotel->final_price ?? '' }}</td>
                        <td>{{ \Carbon\Carbon::parse($hotel->created_at)->format('d F Y') ?? '' }}</td>
                        <td>{{ $hotel->transfer->team->name ?? '' }}</td>
                        {{-- <td>{{ $hotel->cost ?? '' }}</td> --}}
                        {{-- <td>
                          @if($hotel->status == 0)
                          <p class="text-danger">Pending</p>
                          @else
                          
                            <p class="text-success">Complete</p>
                          @endif
                        </td> --}}
                        {{-- <td>{{ $hotel->vehicle ?? '' }}</td> --}}
 
                      @if(Auth::user()->power == 4)
                      <td>
    
                        <form action="{{ route('hotelsbooking.updateStatus', $hotel->id) }}" method="POST" style="display:inline;">
                          @csrf
                          @method('PATCH') <!-- Change from PUT to PATCH -->
                      
                          <!-- Show "Complete" or "Cancel" buttons based on the current status -->
                          @if($hotel->status == 0)
                              <!-- Pending, show Complete and Cancel buttons -->

                              <button type="submit" class="btn btn-info" 
                                      name="status_action" value="accept" 
                                      onclick="return confirm('Are you sure you want to change the status to Complete?')">
                                  Accept
                              </button>
                      
                              <button type="submit" class="btn btn-danger mt-2" 
                                      name="status_action" value="cancel" 
                                      onclick="return confirm('Are you sure you want to cancel this booking?')">
                                  Reject
                              </button>
                          @elseif($hotel->status == 3)

                          <button type="submit" class="btn btn-info" 
                          name="status_action" value="process" 
                          onclick="return confirm('Are you sure you want to change the status to Complete?')">
                          In Process
                  </button>

                  <button type="submit" class="btn btn-danger mt-2" 
                          name="status_action" value="cancel" 
                          onclick="return confirm('Are you sure you want to cancel this booking?')">
                      Reject
                  </button>

                  <a href="{{ route('remark_hotels_booking', ['id' =>    $hotel->id]) }}" class="btn btn-success mt-2">
                    Add Remark
                  </a>

                  <a href="{{ route('upgradehotelrequest', ['id' => $hotel->id]) }}" class="btn btn-danger mt-2">
                                View Request
                              </a>

                  <a href="{{ route('viewremarkhotelsbooking', ['id' =>    $hotel->id]) }}" class="btn btn-success mt-2">
                    View Remark
                  </a>
                          @elseif($hotel->status == 4)

                  <button type="submit" class="btn btn-info" 
                          name="status_action" value="complete" 
                          onclick="return confirm('Are you sure you want to change the status to Complete?')">
                      Complete
                  </button>

                  <button type="submit" class="btn btn-danger mt-2" 
                          name="status_action" value="cancel" 
                          onclick="return confirm('Are you sure you want to cancel this booking?')">
                      Reject
                  </button>

                  @if(empty($hotel->transfer->team->name))
                  <a href="{{ route('transfer_hotels_booking', ['id' =>    $hotel->id]) }}" class="btn btn-success mt-2">
                    Transfer
                  </a>
                  @endif

                  <a href="{{ route('remark_hotels_booking', ['id' =>    $hotel->id]) }}" class="btn btn-success mt-2">
                    Add Remark
                  </a>

                  <a href="{{ route('upgradehotelrequest', ['id' => $hotel->id]) }}" class="btn btn-danger mt-2">
                                View Request
                              </a>

                  <a href="{{ route('viewremarkhotelsbooking', ['id' =>    $hotel->id]) }}" class="btn btn-success mt-2">
                    View Remark
                  </a>

                          @elseif($hotel->status == 1)
                          <p class="text-success">Completed</p>
                              <!-- Confirmed, show Cancel button -->
                              {{-- <button type="submit" class="btn btn-danger mt-3" 
                                      name="status_action" value="cancel" 
                                      onclick="return confirm('Are you sure you want to cancel this booking?')">
                                  Cancel
                              </button> --}}
                              <a href="{{ route('viewremarkhotelsbooking', ['id' =>    $hotel->id]) }}" class="btn btn-success mt-2">
                                View Remark
                              </a>
                          @else
                          @if($hotel->status == 1)
                              <p class="text-success">Completed</p>
                              @elseif($hotel->status == 3)
                              <p class="text-success">Accepted</p>
                              @else
                              <p class="text-danger">Rejected</p>
                              <a href="{{ route('viewremarkhotelsbooking', ['id' =>    $hotel->id]) }}" class="btn btn-success mt-2">
                                View Remark
                              </a>
                              @endif
                              
                          @endif
                      </form>
                      
                </td>
                      @else
                        <td>
                                <!-- Update Status Button -->
                                <form action="{{ route('hotelsbooking.updateStatus', $hotel->id) }}" method="POST" style="display:inline;">
                                  @csrf
                                  @method('PATCH') <!-- Change from PUT to PATCH -->
                              
                                  <!-- Show "Complete" or "Cancel" buttons based on the current status -->
                                  @if($hotel->status == 0)
                                      <!-- Pending, show Complete and Cancel buttons -->

                                      <button type="submit" class="btn btn-info" 
                                              name="status_action" value="accept" 
                                              onclick="return confirm('Are you sure you want to change the status to Complete?')">
                                          Accept
                                      </button>
                              
                                      <button type="submit" class="btn btn-danger mt-2" 
                                              name="status_action" value="cancel" 
                                              onclick="return confirm('Are you sure you want to cancel this booking?')">
                                          Reject
                                      </button>
                                     
                                  @elseif($hotel->status == 3)

                                  <button type="submit" class="btn btn-info" 
                                          name="status_action" value="process" 
                                          onclick="return confirm('Are you sure you want to change the status to Complete?')">
                                          In Process
                                  </button>
                                  {{-- <button type="submit" class="btn btn-info" 
                                          name="status_action" value="complete" 
                                          onclick="return confirm('Are you sure you want to change the status to Complete?')">
                                      Complete
                                  </button> --}}

                                  <button type="submit" class="btn btn-danger mt-2" 
                                          name="status_action" value="cancel" 
                                          onclick="return confirm('Are you sure you want to cancel this booking?')">
                                      Reject
                                  </button>

                                  @if(empty($hotel->transfer->team->name))
                                  <a href="{{ route('transfer_hotels_booking', ['id' =>    $hotel->id]) }}" class="btn btn-success mt-2">
                                    Transfer
                                  </a>
                                  @endif

                                  <a href="{{ route('remark_hotels_booking', ['id' =>    $hotel->id]) }}" class="btn btn-success mt-2">
                                    Add Remark
                                  </a>

                                  <a href="{{ route('upgradehotelrequest', ['id' => $hotel->id]) }}" class="btn btn-danger mt-2">
                                View Request
                              </a>

                                  <a href="{{ route('viewremarkhotelsbooking', ['id' =>    $hotel->id]) }}" class="btn btn-success mt-2">
                                    View Remark
                                  </a>
                                  @elseif($hotel->status == 4)

                                  <button type="submit" class="btn btn-info" 
                                          name="status_action" value="complete" 
                                          onclick="return confirm('Are you sure you want to change the status to Complete?')">
                                      Complete
                                  </button>

                                  <button type="submit" class="btn btn-danger mt-2" 
                                          name="status_action" value="cancel" 
                                          onclick="return confirm('Are you sure you want to cancel this booking?')">
                                      Reject
                                  </button>

                                  @if(empty($hotel->transfer->team->name))
                                  <a href="{{ route('transfer_hotels_booking', ['id' =>    $hotel->id]) }}" class="btn btn-success mt-2">
                                    Transfer
                                  </a>
                                  @endif

                                  <a href="{{ route('remark_hotels_booking', ['id' =>    $hotel->id]) }}" class="btn btn-success mt-2">
                                    Add Remark
                                  </a>

                                  <a href="{{ route('upgradehotelrequest', ['id' => $hotel->id]) }}" class="btn btn-danger mt-2">
                                View Request
                              </a>

                                  <a href="{{ route('viewremarkhotelsbooking', ['id' =>    $hotel->id]) }}" class="btn btn-success mt-2">
                                    View Remark
                                  </a>
    

                                  @elseif($hotel->status == 1)
                                  <p class="text-success">Completed</p>
                                      <!-- Confirmed, show Cancel button -->
                                      {{-- <button type="submit" class="btn btn-danger mt-3" 
                                              name="status_action" value="cancel" 
                                              onclick="return confirm('Are you sure you want to cancel this booking?')">
                                          Cancel
                                      </button> --}}
                                  @else
                                  @if($hotel->status == 1)
                                      <p class="text-success">Completed</p>
                                      @elseif($hotel->status == 3)
                                      <p class="text-success">Accepted</p>
                                      @else
                                      <p class="text-danger">Rejected</p>
                                      @endif
                                      
                                  @endif
                              </form>
                              <a href="{{ route('customer_hotel', ['id' => $hotel->id]) }}" class="btn btn-danger mt-2">
                                View Customer
                              </a>
                             
                              
                        </td>
                        @endif
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