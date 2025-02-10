@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Converted Customer Calls</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Converted Customer Calls</a></li>
            <li class="breadcrumb-item active">View Converted Customer Calls</li>
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
                  <h4 class="mt-0 header-title">View Converted Customer Calls List</h4>
                </div>
                {{-- <div class="col-md-2"> <a class="btn btn-info cticket" href="{{route('add_customer')}}" role="button" style="margin-left: 20px;"> Add Customer Calls</a></div> --}}
              </div>
              <hr style="margin-bottom: 50px;background-color: darkgrey;">
              <div class="table-rep-plugin">
                <div class="table-responsive b-0" data-pattern="priority-columns">
                  <table id="userTable" class="table  table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th data-priority="1">Name</th>
                        <th data-priority="3">package enquiry details</th>
                        <th data-priority="1">Interest Details</th>
                        <th data-priority="3">Phone</th>
                        <th data-priority="6">State</th>
                        <th data-priority="6">City</th>
                        <th data-priority="6">Mark Lead</th>
                        <th data-priority="6">Date</th>
                        <th data-priority="6">Action</th>
                      </tr>
                    </thead>
                   <tbody>
                        @foreach($agent as $key=> $value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$value->name ?? ''}}</td>
                                <td>{{$value->package_enquiry_details ?? ''}}</td>
                                <td>{{$value->interest_details ?? ''}}</td>
                                <td>{{$value->phone ?? ''}}</td>
                                <td>{{$value->state->state_name ?? ''}}</td>
                                <td>{{$value->cities->city_name ?? ''}}</td>
                                @if($value->mark_lead == 1)
                                <td>Ongoing</td>
                                @elseif($value->mark_lead == 2)
                                <td>Cancelled</td>
                                @else
                                <td>Converted</td>
                                @endif
                                <td>
                                  {{ \Carbon\Carbon::parse($value->created_at)->format('Y M j') ?? '' }}
                                </td>
                                <td>
                                    <a href="{{ route('customer.edit', $value->id) }}" class="btn btn-primary">
                                        Edit
                                    </a>
                                    <!-- Delete Form -->
                                    <form action="{{ route('customer.destroy', $value->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE') 
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">
                                            Delete
                                        </button>
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