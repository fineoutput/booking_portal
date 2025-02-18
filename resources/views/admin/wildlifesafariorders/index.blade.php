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
                        <th data-priority="1">State</th>
                        <th data-priority="1">City</th>
                        <th data-priority="1">National Park</th>
                        <th data-priority="1">Date</th>
                        <th data-priority="1">Timings</th>
                        <th data-priority="1">Vehicle</th>
                        <th data-priority="1">Cost</th>
                        <th data-priority="1">Persons</th>
                        <th data-priority="1">Adults</th>
                        <th data-priority="1">Kids</th>
                        <th data-priority="6">Action</th>
                      </tr>
                    </thead>
                   <tbody>
                    @foreach($WildlifeSafari as $key=> $hotel)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $hotel->safari->state->state_name ?? '' }}</td>
                        <td>{{ $hotel->safari->cities->city_name ?? '' }}</td>
                        <td>{{ $hotel->safari->national_park ?? '' }}</td>
                        <td>{{ $hotel->safari->date ?? '' }}</td>
                        <td>{{ $hotel->timings ?? '' }}</td>
                        <td>{{ $hotel->vehicle ?? '' }}</td>
                        <td>{{ $hotel->cost ?? '' }}</td>
                        <td>{{ $hotel->no_persons ?? '' }}</td>
                        <td>{{ $hotel->no_adults ?? '' }}</td>
                        <td>{{ $hotel->no_kids ?? '' }}</td>
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
                                <form action="{{ route('wild_life_safari_order.updateStatus', $hotel->id) }}" method="POST" style="display:inline;">
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