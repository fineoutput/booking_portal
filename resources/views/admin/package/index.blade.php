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
                  <div style="width: 100%; overflow-x: auto;">
                  <table id="userTable"  class="table  table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th data-priority="1">Package Name</th>
                        <th data-priority="3">State Citys</th>
                        {{-- <th data-priority="1">City</th> --}}
                        <th data-priority="1">PDF File</th>
                        <th data-priority="3">Images</th>
                        <th data-priority="3">Videos</th>
                        <th data-priority="6">Text Description</th>
                        <th data-priority="6">Text Description 2</th>
                        <th data-priority="6">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($package as $key => $pkg)
                      <tr>
                          <td>{{ $key + 1 }}</td>
                          <td>{{ $pkg->package_name ?? '' }}</td>

                          <td class="states" style="width: 404px !important;">
                            @if($pkg->state_id && $pkg->city_id)
                                @php
                                    $stateIds = explode(',', $pkg->state_id); // List of state IDs
                                    $cityIds = explode(',', $pkg->city_id);  // List of city IDs
                                    $stateCityPairs = [];
                                @endphp
                        
                                @foreach($stateIds as $index => $stateId)
                                    @php
                                        $state = \App\Models\State::find($stateId);
                                        $city = \App\Models\City::find($cityIds[$index] ?? null); // Get the city for the current index
                                        
                                        // If the state is found, get the state name and code (abbreviation)
                                        $stateName = $state ? $state->state_name : 'State Not Found';
                                        $stateCode = $state ? $state->state_code : ''; // Assuming there's a 'state_code' field
                                        
                                        // If the city is found, get the city name
                                        $cityName = $city ? $city->city_name : 'City Not Found';
                                        
                                        // Add the state = city pair
                                        $stateCityPairs[] = $stateName . ' [' . $stateCode . '] = ' . $cityName;
                                    @endphp
                                @endforeach
                        
                                {{ implode('<br>', $stateCityPairs) }} <!-- Display each pair on a new line -->
                            @else
                                {{ '' }}
                            @endif
                        </td>


                          <td>
                              @if ($pkg->pdf)
                                  <!-- Display PDF Inline -->
                                  <embed src="{{ asset('storage/' . $pkg->pdf) }}" type="application/pdf" width="100%" height="100px" />
                                  
                                  <!-- Download Button -->
                                  <br />
                                  <a href="{{ asset('storage/' . $pkg->pdf) }}" class="btn btn-primary" download target="_blank">
                                      Download PDF
                                  </a>
                              @else
                                  No PDF available
                              @endif
                          </td>
                  
                          <!-- Display Images -->
                          <td>
                              @foreach (json_decode($pkg->image) as $image)
                                  <img src="{{ asset($image) }}" alt="Image" style="width: 100px; height: auto; margin: 5px;">
                              @endforeach
                          </td>
                  
                          <!-- Display Videos -->
                          <td>
                              @foreach (json_decode($pkg->video) as $video)
                                  <video width="150" controls>
                                      <source src="{{ asset($video) }}" type="video/mp4">
                                      Your browser does not support the video tag.
                                  </video>
                              @endforeach
                          </td>
                  
                          <td>{!! \Str::words($pkg->text_description, 20) !!}</td>
                          <td>{!! \Str::words($pkg->text_description_2, 20) !!}</td>

                  
                          <td>
                              <!-- Edit Button -->
                              <a href="{{ route('packages.edit', $pkg->id) }}" class="btn btn-warning">Edit</a>
                              
                              <!-- Delete Form -->
                              <form action="{{ route('packages.destroy', $pkg->id) }}" method="POST" style="display:inline;">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger mt-2" onclick="return confirm('Are you sure you want to delete this package?')">Delete</button>
                              </form>
                  
                              <a href="{{ route('package_price', $pkg->id) }}" class="btn btn-warning mt-2">Add Price</a>
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