@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Trip Guide Booking</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Trip Guide Booking</a></li>
            <li class="breadcrumb-item active">View Trip Guide Booking</li>
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
                  <h4 class="mt-0 header-title">View Trip Guide Booking List</h4>
                </div>
                {{-- <div class="col-md-2"> <a class="btn btn-info cticket" href="{{route('tripguide_create')}}" role="button" style="margin-left: 20px;"> Add Trip Guide</a></div> --}}
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
                        <th data-priority="1">State</th>
                        <th data-priority="1">City</th>
                        <th data-priority="1">Language</th>
                        <th data-priority="1">Guide Type</th>
                        <!-- <th data-priority="1">Local Guide</th>
                        <th data-priority="1">Out Station Guide</th> -->
                        <th data-priority="1">Agent Margin</th>
                        <th data-priority="1">Final Cost</th>
                        <th data-priority="1">Action</th>
                      </tr>
                    </thead>
                   <tbody>
                    @foreach($TripGuideBook as $key=> $hotel)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $hotel->user->name ?? '' }}</td>
                        <td>{{ $hotel->salesman_name ?? '' }}</td>
                        <td>{{ $hotel->salesman_mobile ?? '' }}</td>
                        <td>{{ $hotel->guide_se->state->state_name ?? '' }}</td>
                        <td>{{ $hotel->guide_se->cities->city_name ?? '' }}</td>
                        <td>{{ $hotel->guide_se->languages->language_name ?? '' }}</td>
                        <td>
            @if($hotel->guide_se->guide_type ?? '')
                @php
                    $guideTypes = explode(',', $hotel->guide_se->guide_type);
                @endphp
                {{ implode(', ', $guideTypes) }}
            @else
                N/A
            @endif
        </td>
                        <td>₹{{ $hotel->agent_margin ?? '0' }}</td>
                        <td>₹{{ $hotel->final_price ?? '0' }}</td>

                        <td>

                            {{-- <form action="{{ route('trip_guide_booking.updateStatus', $hotel->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT') <!-- Use PUT method for updating status -->
                                
                                @if($hotel->status == 0)
                                <button type="submit" class="btn btn-info" onclick="return confirm('Are you sure you want to change the status?')" 
                                        {{ $hotel->status == 1 ? 'disabled title=Status is already Complete' : '' }}>
                                    {{ $hotel->status == 1 ? 'Complete' : 'Complete' }}
                                </button>
                                @else
                                <p class="text-success">Completed</p>
                                @endif
                            </form> --}}

                            <form action="{{ route('trip_guide_booking.updateStatus', $hotel->id) }}" method="POST" style="display:inline;">
                              @csrf
                              @method('PUT') <!-- Change from PUT to PATCH -->
                          
                              <!-- Show "Complete" or "Cancel" buttons based on the current status -->
                              @if($hotel->status == 0)
                                  <!-- Pending, show Complete and Cancel buttons -->
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