@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Package</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Package</a></li>
            <li class="breadcrumb-item active">View Package</li>
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
                  <h4 class="mt-0 header-title">View Package List</h4>
                </div>
                <div class="col-md-2"> <a class="btn btn-info cticket" href="{{route('add_package')}}" role="button" style="margin-left: 20px;"> Add Package</a></div>
              </div>
              <hr style="margin-bottom: 50px;background-color: darkgrey;">
              <div class="table-rep-plugin">
                <div class="table-responsive b-0" data-pattern="priority-columns">
                  <table id="userTable" class="table  table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th data-priority="1">Package Name</th>
                        <th data-priority="3">State</th>
                        <th data-priority="1">City</th>
                        <th data-priority="3">Images</th>
                        <th data-priority="3">Videos</th>
                        <th data-priority="6">Text Description</th>
                        <th data-priority="6">Text Description 2</th>
                        <th data-priority="6">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($package as $key=> $pkg)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{ $pkg->package_name ?? '' }}</td>
                                <td>{{ $pkg->state_id ?? '' }}</td>
                                <td>{{ $pkg->city_id ?? '' }}</td>

                                <!-- Display Images -->
                                <td>
                                    @foreach (json_decode($pkg->image) as $image)
                                        <img src="{{ asset('storage/' . $image) }}" alt="Image" style="width: 100px; height: auto; margin: 5px;">
                                    @endforeach
                                </td>

                                <!-- Display Videos -->
                                <td>
                                    @foreach (json_decode($pkg->video) as $video)
                                        <video width="150" controls>
                                            <source src="{{ asset('storage/' . $video) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @endforeach
                                </td>
                                <td>{!! $pkg->text_description !!}</td>
                                <td>{!! $pkg->text_description_2 !!}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <a href="{{ route('packages.edit', $pkg->id) }}" class="btn btn-warning">Edit</a>
                                    
                                    <!-- Delete Form -->
                                    <form action="{{ route('packages.destroy', $pkg->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE') <!-- This generates a DELETE request -->
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this package?')">Delete</button>
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