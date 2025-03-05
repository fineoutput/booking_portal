@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View {{$title}} Wallet Request</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Taxi Booking</a></li>
            <li class="breadcrumb-item active">View Taxi Booking</li>
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
                  <h4 class="mt-0 header-title">View Taxi Booking List</h4>
                </div>
                {{-- <div class="col-md-2"> <a class="btn btn-info cticket" href="{{route('vehicle_crete')}}" role="button" style="margin-left: 20px;"> Add Vehicle</a></div> --}}
              </div>
              <hr style="margin-bottom: 50px;background-color: darkgrey;">
              <div class="table-rep-plugin">
                <div class="table-responsive b-0" data-pattern="priority-columns">
                  <table id="userTable" class="table  table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Note</th>
                        <th>Action</th>
                   

                      </tr>
                    </thead>
                   <tbody>
                        @foreach($wallet as $key=> $value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$value->user->name ?? ''}}</td>
                                <td>₹{{$value->amount ?? '0'}}</td>
                                <td>{!!$value->note !!}</td>
                                <td>
                                    @if($value->transaction_type == 'refund')
                                    <form action="{{ route('wallet.updateStatus', $value->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT') 
                                        
                                        @if($value->status == 0) 
                                            <!-- If status is 0 (pending), show Accept and Reject buttons -->
                                            <button type="submit" class="btn btn-info" 
                                                    name="status_action" value="complete" 
                                                    onclick="return confirm('Are you sure you want to change the status to Accept?')">
                                                Accept
                                            </button>
                                
                                            <button type="submit" class="btn btn-danger" 
                                                    name="status_action" value="cancel" 
                                                    onclick="return confirm('Are you sure you want to cancel this booking?')">
                                                Reject
                                            </button>
                                        
                                        @elseif($value->status == 1) 
                                            <!-- If status is 1 (accepted), display Accepted message -->
                                            <p class="text-success">Accepted</p>
                                        
                                        @elseif($value->status == 2) 
                                            <!-- If status is 2 (rejected), display Rejected message -->
                                            <p class="text-danger">Rejected</p>
                                        
                                        @endif
                                    </form>
                                @else
                                    <!-- If it's not a refund transaction, just show Recharge -->
                                    <p class="text-success">Recharge</p>
                                @endif
                                
                                
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