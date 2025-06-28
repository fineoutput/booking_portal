@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Hotel Customer</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Hotel Customer</a></li>
            <li class="breadcrumb-item active">View Hotel </li>
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
                  <h4 class="mt-0 header-title">View Hotel Customer List</h4>
                </div>
              </div>
              <hr style="margin-bottom: 50px;background-color: darkgrey;">
              <div class="table-rep-plugin">
                <div class="table-responsive b-0" data-pattern="priority-columns">
                  <div style="width: 100%; overflow-x: auto;">
                  <table id="userTable"  class="table  table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th data-priority="1">User Name</th>
                        <th data-priority="3">Booking id</th>
                        {{-- <th data-priority="1">City</th> --}}
                        <th data-priority="1">Name</th>
                        <th data-priority="3">Age</th>
                        <th data-priority="3">Phone</th>
                        <th data-priority="6">Aadhar Front Image</th>
                        <th data-priority="6">Aadhar Back Image</th>
                        <th data-priority="6">Additional information	</th>

                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($tourist as $key => $value)
                      <tr>
                         <td>{{$key+1}}</td>
                         <td>{{$value->user->name ?? ''}}</td>
                         <td>#{{$value->booking_id ?? ''}}</td>
                         <td>{{$value->name ?? ''}}</td>
                         <td>{{$value->age ?? ''}}</td>
                         <td>{{$value->phone ?? ''}}</td>
                         <td>
                            <img width="100" src="{{ asset($value->aadhar_front) }}" alt="No Image">
                         </td>
                         <td>
                            <img width="100" src="{{ asset($value->aadhar_back) }}" alt="No Image">
                         </td>
                         <td>
                            {{ $value->additional_info	 ?? ''}}
                         </td>
                      </tr>
                  @endforeach
                    </tbody>
                  </table>
                </div>
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