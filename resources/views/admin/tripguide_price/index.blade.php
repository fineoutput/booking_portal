@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Trip Guide Price</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Trip Guide Price</a></li>
            <li class="breadcrumb-item active">View Trip Guide Price</li>
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
                  <h4 class="mt-0 header-title">View Trip Guide Price List</h4>
                </div>
                <div class="col-md-2"> <a class="btn btn-info cticket" href="{{route('tripguide_price_create', $trip->id)}}" role="button" style="margin-left: 20px;"> Add Trip Guide Price</a></div>
              </div>
              <hr style="margin-bottom: 50px;background-color: darkgrey;">
              <div class="table-rep-plugin">
                <div class="table-responsive b-0" data-pattern="priority-columns">
                  <table id="userTable" class="table  table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th data-priority="1">Trip</th>
                        <th data-priority="1">1 To 4</th>
                        <th data-priority="1">5</th>
                        <th data-priority="1">6</th>
                        <th data-priority="1">6 To 10</th>
                        <th data-priority="6">Action</th>
                      </tr>
                    </thead>
                   <tbody>
                    @foreach($trip_price as $key=> $hotel)
                    <tr>
                        <td>{{ $key+1 }}</td> 
                        <td>{{ $hotel->trip->city_id ?? '' }}</td>
                        <td>{{ $hotel->price_1_to_4 ?? '' }}</td>
                        {{-- <td>{{ $hotel->location ?? '' }}</td> --}}
                        <td>{{ $hotel->price_5 ?? '' }}</td>
                        <td>{{ $hotel->price_6 ?? '' }}</td>
                        <td>{{ $hotel->price_6_to_10 ?? '' }}</td>

                        <td>
                            <a href="{{ route('tripguide_price.edit', $hotel->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('tripguide_price.destroy', $hotel->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Safari?')">Delete</button>
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