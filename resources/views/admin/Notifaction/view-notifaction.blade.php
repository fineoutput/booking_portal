@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Hotels</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Hotels</a></li>
            <li class="breadcrumb-item active">View Hotels</li>
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
                  <h4 class="mt-0 header-title">View Hotels List</h4>
                </div>
                <div class="col-md-2"> <a class="btn btn-info cticket" href="{{route('add_hotels')}}" role="button" style="margin-left: 20px;"> Add Hotels</a></div>
              </div>
              <hr style="margin-bottom: 50px;background-color: darkgrey;">
              <div class="table-rep-plugin">
                <div class="table-responsive b-0" data-pattern="priority-columns">
                  <table id="userTable" class="table  table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th data-priority="1">Title</th>
                        <th data-priority="3">Description</th>
                        <th data-priority="1">IP</th>
                        <th data-priority="3">Date</th>
                        <th data-priority="3">Image</th>
                        {{-- <th data-priority="6">Action</th> --}}
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($notifications as $key => $notification)
                            <tr>
                                <td>{{ $key + 1 }}</td>  <!-- Show row number -->
                                <td>{{ $notification->title }}</td> <!-- Title of notification -->
                                <td>{{ $notification->description }}</td> <!-- Description of notification -->
                                <td>{{ $notification->ip }}</td> <!-- IP address -->
                                <td>{{ \Carbon\Carbon::parse($notification->date)->format('Y-m-d H:i:s') }}</td> <!-- Formatted date -->
                                <td>
                                    @if ($notification->image) 
                                        <img src="{{ asset($notification->image) }}" alt="Image" width="50" height="50">
                                    @else 
                                        No image 
                                    @endif
                                </td> <!-- Show image or "No image" if not available -->
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