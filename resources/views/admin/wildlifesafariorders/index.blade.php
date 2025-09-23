@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Safari</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Safari</a></li>
            <li class="breadcrumb-item active">View Safari</li>
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
                  <h4 class="mt-0 header-title">View Safari List</h4>
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
                        <th data-priority="1">Salesman Mobile	</th>
                        <th data-priority="1">State</th>
                        <th data-priority="1">City</th>
                        <th data-priority="1">National Park</th>
                        <th data-priority="1">Date</th>
                        <th data-priority="1">Timings</th>
                        <th data-priority="1">Vehicle</th>
                        <th data-priority="1">Children</th>
                        <th data-priority="1">Children Ages</th>
                        <th data-priority="1">Adults</th>
                        <th data-priority="1">Kids</th>
                        <th data-priority="1">Agent Margin</th>
                        <th data-priority="1">Final Cost</th>
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
                        <td>{{ $hotel->safari->state->state_name ?? '' }}</td>
                        <td>{{ $hotel->safari->cities->city_name ?? '' }}</td>
                        <td>{{ $hotel->safari->national_park ?? '' }}</td>
                        <td>{{ $hotel->safari->date ?? '' }}</td>
                        <td>{{ $hotel->safari_se->timings ?? '' }}</td>
                        <td>{{ $hotel->safari_se->vehicle ?? '' }}</td>
                        <td>{{ $hotel->safari_se->no_persons ?? '' }}</td>
                        <td>
                          @php
                              $childAges = json_decode($hotel->safari_se->child_age ?? '[]', true);
                          @endphp

                          @if(is_array($childAges) && count($childAges) > 0)
                              @foreach($childAges as $age)
                                  {{ $age }}@if(!$loop->last), @endif
                              @endforeach
                          @else
                              No Child Ages
                          @endif
                      </td>
                        <td>{{ $hotel->safari_se->no_adults ?? '' }}</td>
                        <td>{{ $hotel->safari_se->no_kids ?? '' }}</td>
                        <td>₹{{ $hotel->agent_margin ?? '' }}</td>
                        <td>₹{{ $hotel->final_price ?? '' }}</td>
                        <td>{{ $hotel->transfer->team->name ?? '' }}</td>

                        @if(Auth::user()->power == 4)
                      <td>
                        <a href="{{ route('wild_life_safari_orders_remarkcreate', ['id' =>    $hotel->id]) }}" class="btn btn-success mt-2">
                          Remark
                        </a>
                        <a href="{{ route('wild_life_safari_orders_view', ['id' =>    $hotel->id]) }}" class="btn btn-danger mt-2">
                          View Remark
                        </a>

                        <form action="{{ route('wild_life_safari_order.updateStatus', $hotel->id) }}" method="POST" style="display:inline;">
                          @csrf
                          @method('PUT') <!-- Change from PUT to PATCH -->
                      
                          <!-- Show "Complete" or "Cancel" buttons based on the current status -->
                          @if($hotel->status == 0)
                              <!-- Pending, show Complete and Cancel buttons -->
                              <button type="submit" class="btn btn-info mt-2" 
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

                            <button type="submit" class="btn btn-info mt-2" 
                              name="status_action" value="complete" 
                              onclick="return confirm('Are you sure you want to change the status to Complete?')">
                              Complete
                            </button>

                            <button type="submit" class="btn btn-danger mt-2" 
                                      name="status_action" value="cancel" 
                                      onclick="return confirm('Are you sure you want to cancel this booking?')">
                                  Reject
                              </button>
                            
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

                      </td>
                        @else
                        <td>
                          
                                <form action="{{ route('wild_life_safari_order.updateStatus', $hotel->id) }}" method="POST" style="display:inline;">
                                  @csrf
                                  @method('PUT') <!-- Change from PUT to PATCH -->
                              
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

                                      @if(empty($hotel->transfer->team->name))
                                      <a href="{{ route('wild_life_safari_orders_transfer', ['id' =>    $hotel->id]) }}" class="btn btn-success mt-2">
                                        Transfer
                                      </a>
                                      @endif
                                      <a href="{{ route('wild_life_safari_orders_remarkcreate', ['id' =>    $hotel->id]) }}" class="btn btn-success mt-2">
                                        Remark
                                      </a>
                                      <a href="{{ route('wild_life_safari_orders_view', ['id' =>    $hotel->id]) }}" class="btn btn-danger mt-2">
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
                                      <a href="{{ route('wild_life_safari_orders_transfer', ['id' =>    $hotel->id]) }}" class="btn btn-success mt-2">
                                        Transfer
                                      </a>
                                      @endif
                                      <a href="{{ route('wild_life_safari_orders_remarkcreate', ['id' =>    $hotel->id]) }}" class="btn btn-success mt-2">
                                        Remark
                                      </a>
                                      <a href="{{ route('wild_life_safari_orders_view', ['id' =>    $hotel->id]) }}" class="btn btn-danger mt-2">
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
                                      <a href="{{ route('wild_life_safari_orders_view', ['id' =>    $hotel->id]) }}" class="btn btn-danger mt-2">
                                        View Remark
                                      </a>
                                  @else
                                  @if($hotel->status == 1)
                                      <p class="text-success">Completed</p>
                                      @elseif($hotel->status == 3)
                                      <p class="text-success">Accepted</p>
                                      @else
                                      <p class="text-danger">Rejected</p>
                                      <a href="{{ route('wild_life_safari_orders_view', ['id' =>    $hotel->id]) }}" class="btn btn-danger mt-2">
                                        View Remark
                                      </a>
                                      @endif
                                  @endif
                              </form>
                              <a href="{{ route('customer_safari', ['id' => $hotel->id]) }}" class="btn btn-danger mt-2">
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