@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Agent</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Agent</a></li>
            <li class="breadcrumb-item active">View Agent</li>
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
                  <h4 class="mt-0 header-title">View Agent List</h4>
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
                        <th data-priority="1">Name</th>
                        <th data-priority="3">Business Name</th>
                        <th data-priority="3">Phone</th>
                        <th data-priority="3">State</th>
                        <th data-priority="3">City</th>
                        <th data-priority="3">Email</th>
                        <th data-priority="3">GST Number</th>
                        <th data-priority="3">Registration Charge</th>
                        <th data-priority="3">Aadhar Image Front</th>
                        <th data-priority="3">Aadhar Image Back</th>
                        <th data-priority="3">Pancard Image</th>
                        <th data-priority="3">Logo</th>
                        <th data-priority="3">Action</th>
                      </tr>
                    </thead>
                   <tbody>
                    @foreach($agent as $key => $value)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $value->name ?? '' }}</td>
        <td>{{ $value->business_name ?? '' }}</td>
        <td>{{ $value->number ?? '' }}</td>
        <td>{{ $value->state->state_name ?? '' }}</td>
        <td>{{ $value->cities->city_name ?? '' }}</td>
        <td>{{ $value->email ?? '' }}</td>
        <td>{{ $value->GST_number ?? '' }}</td>
        <td>{{ $value->registration_charge ?? '' }}</td>
        
        <!-- Display Aadhar Image -->
        <td>
          @if($value->aadhar_image)
              <img src="{{ asset('storage/' . $value->aadhar_image) }}" alt="Aadhar Image" style="max-width: 100px; max-height: 100px;">
          @else
              N/A
          @endif
      </td>

        <!-- Display Aadhar Image Back -->
        <td>
            @if($value->aadhar_image_back)
                <img src="{{ asset('storage/' . $value->aadhar_image_back) }}" alt="Aadhar Image Back" style="max-width: 100px; max-height: 100px;">
            @else
                N/A
            @endif
        </td>
        
        <!-- Display PAN Image -->
        <td>
            @if($value->pan_image)
                <img src="{{ asset('storage/' . $value->pan_image) }}" alt="PAN Image" style="max-width: 100px; max-height: 100px;">
            @else
                N/A
            @endif
        </td>
        
        <!-- Display Logo -->
        <td>
            @if($value->logo)
                <img src="{{ asset('storage/' . $value->logo) }}" alt="Logo" style="max-width: 100px; max-height: 100px;">
            @else
                N/A
            @endif
        </td>

        <td>
            <form action="{{ route('agent.updateStatus', $value->id) }}" method="POST" style="display:inline;">
           @csrf
           @method('PATCH') <!-- Change from PUT to PATCH -->
       
           @if($value->approved == 0)
           <button type="submit" class="btn btn-info" onclick="return confirm('Are you sure you want to change the status?')" 
                   {{ $value->status == 1 ? 'disabled title=Status is already Approved' : '' }}>
               {{ $value->status == 1 ? 'Approve' : 'Approve' }}
           </button>
           @else
           <p class="text-success">Approved</p>
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