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
                        <th data-priority="1">Name</th>
                        <th data-priority="1">State</th>
                        <th data-priority="1">City</th>
                        <th data-priority="3">Location</th>
                        <th data-priority="1">Hotel Category</th>
                        <th data-priority="3">Package</th>
                        <th data-priority="3">Image</th>
                        <th data-priority="6">Action</th>
                      </tr>
                    </thead>
                   <tbody>
                    @foreach($hotels as $key=> $hotel)
                    <tr>
                        <td>{{ $key+1 }}</td> <!-- Loop index -->
                        <td>{{ $hotel->name }}</td>
                        <td>{{ $hotel->state->state_name ?? '' }}</td>
                        <td>{{ $hotel->cities->city_name ?? '' }}</td>
                        <td>{{ $hotel->location }}</td>
                        <td>{{ $hotel->hotel_category }}</td>
                        <td>
                          @php
                          $propertyIds = explode(',', $hotel->package_id);  
                          $isFirst = true;  // Variable to track the first iteration
                      @endphp
                     @foreach ($propertyIds as $propertyId)
                        @php
                           $property = \App\Models\Package::find($propertyId);  
                        @endphp
                  
                        @if ($property)
                          @if (!$isFirst) 
                              ,
                          @endif
                          {{ $property->package_name }}
                  
                          @php
                              $isFirst = false;
                          @endphp
                          @else
                            Package not found
                          @endif
                      @endforeach

                        </td>
                        <td>
                          @foreach (json_decode($hotel->images) as $image)
                              <img src="{{ Storage::url($image) }}" alt="Image" style="width: 100px; height: auto; margin: 5px;">
                          @endforeach
                      </td>
                        <td>
                            <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this hotel?')">Delete</button>
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