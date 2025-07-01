@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">Notification</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Notification</a></li>
            <li class="breadcrumb-item active">Notification</li>
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
                  <h4 class="mt-0 header-title">Remark List</h4>
                </div>
              
              </div>
              <hr style="margin-bottom: 50px;background-color: darkgrey;">
              <div class="table-rep-plugin">
                <div class="table-responsive b-0" data-pattern="priority-columns">
                  <table id="userTable" class="table  table-striped">
                    <thead>

                      <tr>
                        <th>#</th>
                        {{-- <th data-priority="1">Booking</th> --}}
                        <th data-priority="1">User</th>
                        <th data-priority="1">User No.</th>
                        <th data-priority="1">Hotels</th>
                        <th data-priority="1">State</th>
                        <th data-priority="1">City</th>
                        <th data-priority="1">Hotel Category</th>
                        <th data-priority="6">Date</th>
                        <th data-priority="1">Images</th>
                        <th data-priority="1">Action</th>
                      </tr>
                    </thead>
                   <tbody>
                       @foreach($UpgradeRequest as $key => $value)
                        <tr>
                          <td>{{$key+1}}</td>
                          {{-- <td>{{$value->booking->id ?? ''}}</td> --}}
                          <td>{{$value->user->name ?? ''}}</td>
                          <td>{{$value->user->number ?? ''}}</td>
                          <td>{{$value->hotels->name ?? ''}}</td>
                          <td>{{$value->hotels->state->state_name ?? ''}}</td>
                          <td>{{$value->hotels->cities->city_name ?? ''}}</td>
                          <td>{{$value->hotels->hotel_category ?? ''}}</td>
                          <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d F Y') ?? '' }}</td>
                          <td>
                            @if($value->hotels->images ?? '')
                            @foreach (json_decode($value->hotels->images) as $image)
                                <img src="{{ asset($image) }}" alt="Image" style="width: 100px; height: auto; margin: 5px;">
                            @endforeach
                            @else
                            <img src="" alt="">
                            @endif
                        </td>
                        <td><a href="{{ route('hotelprefrencerequest', ['id' => $value->booking_id]) }}">View</a></td>



                        {{-- <td>
                          <a href="{{ route('slider.edit', $value->id) }}" class="btn btn-primary">
                            Edit
                        </a>
                            <!-- Delete Form -->
                          <form action="{{ route('slider.destroy', $value->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this vehicle price?')">Delete</button>
                        </form>
                        </td> --}}
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