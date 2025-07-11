@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Hotel Upgrade  Request</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Hotel Upgrade  Request</a></li>
            <li class="breadcrumb-item active">View Hotel Upgrade  Request</li>
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
                  <h4 class="mt-0 header-title">View Package List Upgrade Request</h4>
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
                        <th data-priority="1">Upgrade Details</th>
                        <th data-priority="3">Notes</th>
                        <th data-priority="6">Action</th>

                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($UpgradeRequest as $key => $value)
                      <tr>
                         <td>{{$key+1}}</td>
                         <td>{{$value->user->name ?? ''}}</td>
                         <td>#{{$value->booking_id ?? ''}}</td>
                         <td>{{$value->upgrade_details ?? ''}}</td>
                         <td>{{$value->notes ?? ''}}</td>
                         <td>
                            <form action="{{ route('upgraderequest.updateStatus', $value->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                @if($value->status == 0)
                                    <button type="submit" class="btn btn-info" 
                                            name="status_action" value="accept" 
                                            onclick="return confirm('Are you sure you want to change the status to Complete?')">
                                        Accept
                                    </button>
                                  
                                    <button type="submit" class="btn btn-danger" 
                                            name="status_action" value="cancel" 
                                            onclick="return confirm('Are you sure you want to cancel this booking?')">
                                        Reject
                                    </button>
                                    @elseif($value->status == 1)
                                    <p class="text-danger">Rejected</p>
                                    @else
                                    <p class="text-success">Accepted</p>
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
          </div>
        </div> <!-- end col -->
      </div> <!-- end row -->
    </div>
    <!-- end page content-->
  </div> <!-- container-fluid -->
</div> <!-- content -->

@endsection