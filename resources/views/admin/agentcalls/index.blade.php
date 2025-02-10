@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Package Agent Calls</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Package Agent Calls</a></li>
            <li class="breadcrumb-item active">View Package Agent Calls</li>
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
                  <h4 class="mt-0 header-title">View Package Agent Calls List</h4>
                </div>
                <div class="col-md-2"> <a class="btn btn-info cticket" href="{{route('add_AgentCalls')}}" role="button" style="margin-left: 20px;"> Add Agent Calls</a></div>
              </div>
              <hr style="margin-bottom: 50px;background-color: darkgrey;">
              <div class="table-rep-plugin">
                <div class="table-responsive b-0" data-pattern="priority-columns">
                  <table id="userTable" class="table  table-striped">

                    <form method="GET" action="{{ route('AgentCalls') }}">
                      <div class="form-group">
                          <label for="start_date">Start Date</label>
                          <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                      </div>
                  
                      <div class="form-group">
                          <label for="end_date">End Date</label>
                          <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                      </div>
                  
                      <button type="submit" class="btn btn-primary mb-5">Filter</button>
                  </form>
                  <!-- Example of link with date filters -->
                 
                  {{-- <a href="{{ route('AgentCalls') }}?start_date={{ request('start_date') }}&end_date={{ request('end_date') }}" class="btn btn-primary mb-5">Filter</a> --}}
                    <thead>
                      <tr>
                        <th>#</th>
                        <th data-priority="1">Name</th>
                        <th data-priority="3">Phone</th>
                        <th data-priority="1">State</th>
                        <th data-priority="3">City</th>
                        <th data-priority="3">Remarks</th>
                        <th data-priority="3">Date</th>
                        <th data-priority="6">Action</th>
                      </tr>
                    </thead>
                   <tbody>
                        @foreach($agentCalls as $key=> $value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$value->name ?? ''}}</td>
                                <td>{{$value->phone ?? ''}}</td>
                                <td>{{$value->state->state_name	 ?? ''}}</td>
                                <td>{{$value->cities->city_name ?? ''}}</td>
                                <td>{{$value->remarks ?? ''}}</td>
                                <td>
                                  {{ \Carbon\Carbon::parse($value->created_at)->format('Y M j') ?? '' }}
                                </td>
                                <td>

                                    <a href="{{ route('AgentCalls.edit', $value->id) }}" class="btn btn-primary">
                                        Edit
                                    </a>
                                    <!-- Delete Form -->
                                    <form action="{{ route('AgentCalls.destroy', $value->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE') <!-- This generates a DELETE request -->
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