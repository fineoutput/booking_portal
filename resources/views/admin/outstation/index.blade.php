@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Outstation Tour</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Outstation Tour</a></li>
            <li class="breadcrumb-item active">View Outstation Tour</li>
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
                  <h4 class="mt-0 header-title">View Outstation Tour List</h4>
                </div>
                <div class="col-md-2"> <a class="btn btn-info cticket" href="{{route('outstation_create')}}" role="button" style="margin-left: 20px;"> Add Outstation Tour</a></div>
              </div>
              <hr style="margin-bottom: 50px;background-color: darkgrey;">
              <div class="table-rep-plugin">
                <div class="table-responsive b-0" data-pattern="priority-columns">
                  <table id="userTable" class="table  table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th data-priority="1">Tour Type</th>
                        <th data-priority="3">Vehicle Type</th>
                        <th data-priority="1">Drop Point</th>
                        <th data-priority="1">Available KM</th>
                        <th data-priority="3">Extra KM Charge</th>
                        <th data-priority="3">Cost</th>
                        <th data-priority="6">Description</th>
                        {{-- <th data-priority="6">Text Description 2</th> --}}
                        <th data-priority="6">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($Outstation as $key=> $value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$value->Route->from_destination ?? ''}} - {{$value->Route->to_destination ?? ''}}</td>
                                <td>{{$value->Vehicle->vehicle_type ?? ''}}</td>
                                <td>{{$value->drop_point ?? ''}}</td>
                                <td>{{$value->available_km ?? ''}}</td>
                                <td>{{$value->extra_km_charge ?? ''}}</td>
                                <td>₹{{$value->cost ?? ''}}</td>
                                <td>{!!$value->description!!}</td>
                                <td>
                                    <a href="{{ route('outstation.edit', $value->id) }}" class="btn btn-warning">Edit</a>

                                    <form action="{{ route('outstation.destroy', $value->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
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