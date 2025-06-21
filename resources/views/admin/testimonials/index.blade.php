@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Testimonials</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Testimonials</a></li>
            <li class="breadcrumb-item active">View Testimonials</li>
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
                  <h4 class="mt-0 header-title">View Testimonials List</h4>
                </div>
                <div class="col-md-2"> <a class="btn btn-info cticket" href="{{route('testimonials_crete')}}" role="button" style="margin-left: 20px;"> Add Testimonials</a></div>
              </div>
              <hr style="margin-bottom: 50px;background-color: darkgrey;">
              <div class="table-rep-plugin">
                <div class="table-responsive b-0" data-pattern="priority-columns">
                  <table id="userTable" class="table  table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th data-priority="1">Type</th>
                        <th data-priority="1">Title</th>
                        <th data-priority="1">Description</th>
                        <th data-priority="1">Image</th>
                        {{-- <th data-priority="3">Description</th> --}}
                        <th data-priority="3">Status</th>
                        <th data-priority="6">Action</th>
                      </tr>
                    </thead>
                   <tbody>
                        @foreach($agent as $key=> $value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$value->type ?? ''}}</td>
                                <td>{{$value->title ?? ''}}</td>
                                <td>{!!$value->description ?? ''!!}</td>
                                <td>
                                  <img height="50px"  width="50px" src="{{asset($value->image)}}" alt="">
                                </td>
                                <td>
                                    <span class="{{ $value->status == 1 ? 'text-success' : 'text-danger' }}">
                                        {{ $value->status == 1 ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>

                                    <a href="{{ route('testimonials.edit', $value->id) }}" class="btn btn-primary">
                                        Edit
                                    </a>
                                    <!-- Delete Form -->
                                    <form action="{{ route('testimonials.destroy', $value->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE') <!-- This generates a DELETE request -->
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">
                                            Delete
                                        </button>
                                    </form>


                                    <form action="{{ route('testimonials.updateStatus', $value->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-warning">
                                            {{ $value->status == 1 ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>

                                    {{-- <a href="{{ route('vehicleprice', $value->id) }}" class="btn btn-primary">
                                      Add Price
                                  </a> --}}

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