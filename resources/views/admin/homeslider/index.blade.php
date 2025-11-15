@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Slider</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Slider</a></li>
            <li class="breadcrumb-item active">View Slider</li>
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
                  <h4 class="mt-0 header-title">View Slider List</h4>
                </div>
                <div class="col-md-2"> <a class="btn btn-info cticket" href="{{route('home_slider.create')}}" role="button" style="margin-left: 20px;"> Add Slider</a></div>
              </div>
              <hr style="margin-bottom: 50px;background-color: darkgrey;">
              <div class="table-rep-plugin">
                <div class="table-responsive b-0" data-pattern="priority-columns">
                  <table id="userTable" class="table  table-striped">
                    <thead>

                      <tr>
                        <th>#</th>
                        <th data-priority="1">Type</th>
                        <th data-priority="1">Type 2</th>
                        <th data-priority="1">Image</th>
                        <th data-priority="1">App Image</th>
                        <th data-priority="1">Video</th>
                        <th data-priority="6">Action</th>
                      </tr>
                    </thead>
                   <tbody>
                       @foreach($VehiclePrice as $key => $value)
                        <tr>
                          <td>{{$key+1}}</td>
                          <td>{{$value->type ?? ''}}</td>
                          <td>{{$value->type_2 ?? ''}}</td>
                          <td>
                              @if($value->image)
                                  <img src="{{ asset($value->image) }}" alt="Image" style="max-width: 100px; height: auto;">
                              @else
                                  No image available
                              @endif
                          </td>
                          <td>
                              @if($value->Appimage)
                                  <img src="{{ asset($value->Appimage) }}" alt="Image" style="max-width: 100px; height: auto;">
                              @else
                                  No image available
                              @endif
                          </td>
                          
                          <td>
                             @if(!empty($value->video))
                                  <video width="150" height="100" controls>
                                      <source src="{{ asset($value->video) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                  </video>
                              @else
                                <p>No Video</p>
                            @endif
                          </td>

                        <td>
                          <a href="{{ route('home_slider.edit', $value->id) }}" class="btn btn-primary">
                            Edit
                        </a>
                            <!-- Delete Form -->
                          <form action="{{ route('home_slider.destroy', $value->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this vehicle price?')">Delete</button>
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