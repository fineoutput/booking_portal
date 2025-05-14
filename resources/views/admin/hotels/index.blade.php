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
                        <th data-priority="3">Meal Plan</th>
                        <th data-priority="3">Image</th>
                        <th data-priority="3">Show on the Frontend</th>
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
                        {{-- <td>{{ $hotel->hotel_category }}</td> --}}
                        <td>
                          @switch($hotel->hotel_category)
                              @case('Standard')
                                  Standard (1 star)
                                  @break
                      
                              @case('Deluxe')
                                  Deluxe (3 star)
                                  @break
                      
                              @case('Premium_3')
                                  Premium (3 star)
                                  @break
                      
                              @case('Super deluxe')
                                  Deluxe (4 star)
                                  @break
                      
                              @case('Premium')
                                  Premium (4 star)
                                  @break
                      
                              @case('Luxury')
                                  Deluxe (5 star)
                                  @break
                      
                              @default
                                  {{ $hotel->hotel_category }} (Unknown category)
                          @endswitch
                      </td>
                      
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
                          @php
                              $mealPlans = explode(',', $hotel->meal_plan);  // Exploding the comma-separated meal plans
                          @endphp
                      
                          @if(count($mealPlans) > 0)
                              @foreach($mealPlans as $plan)
                                  @if($plan == 'meal_plan_only_room')
                                      Meal Plan (Only Room)
                                  @elseif($plan == 'meal_plan_breakfast')
                                      Meal Plan (Breakfast)
                                  @elseif($plan == 'meal_plan_all_meals')
                                      Meal Plan (All Meals)
                                  @elseif($plan == 'meal_plan_breakfast_lunch_dinner')
                                      Meal Plan (Breakfast + Lunch/Dinner)
                                  @else
                                      No Meals Selected
                                  @endif
                                  <br>  <!-- Line break for each meal plan -->
                              @endforeach
                          @else
                              No Meals Selected
                          @endif
                      </td>
                      <td>
                        @if (!empty($hotel->images) && json_decode($hotel->images))
                            @foreach (json_decode($hotel->images) as $image)
                                <img src="{{ asset($image) }}" alt="Image" style="width: 100px; height: auto; margin: 5px;">
                            @endforeach
                        @else
                            <span>No images available</span>
                        @endif
                    </td>
                    

                      <td>
                        <form id="form_{{ $hotel->id }}" action="{{ route('show_front_hotels', ['id' => $hotel->id]) }}" method="POST">
                            @csrf <!-- CSRF token for security -->
                            <input 
                                type="checkbox" 
                                name="show_front" 
                                id="show_front_{{ $hotel->id }}" 
                                data-hotel-id="{{ $hotel->id }}"
                                value="1" 
                                {{ $hotel->show_front ? 'checked' : '' }}>
                            <label for="show_front_{{ $hotel->id }}">Show on Frontend</label>
                            <input type="hidden" name="show_front_value" id="show_front_value_{{ $hotel->id }}" value="{{ $hotel->show_front ? '1' : '0' }}">
                        </form>
                    </td>


                        <td>
                            <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this hotel?')">Delete</button>
                            </form>
                            <a href="{{ route('hotel_price', $hotel->id) }}" class="btn btn-success mt-2">Add Price</a>
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function() {
      // Add event listener to the checkbox
      $('input[type="checkbox"]').on('change', function() {
          const hotelId = $(this).data('hotel-id'); // Get the hotel ID from data attribute
          const hiddenInput = $('#show_front_value_' + hotelId); // Get the hidden input for the checkbox
          
          // Set the hidden input value based on the checkbox state (checked = 1, unchecked = 0)
          hiddenInput.val(this.checked ? '1' : '0');
          
          // Send the AJAX request to update the database
          $.ajax({
              url: '{{ route('show_front_hotels', ['id' => '__hotel_id__']) }}'.replace('__hotel_id__', hotelId), // Dynamic route with the hotel ID
              method: 'POST',
              data: {
                  _token: '{{ csrf_token() }}',  // CSRF token
                  show_front_value: hiddenInput.val()  // Send the hidden value (1 or 0)
              },
              success: function(response) {
                  if (response.success) {
                      // Optionally, show a success message
                      alert(response.message);
                  }
              },
              error: function(xhr, status, error) {
                  // Handle errors if any
                  alert('There was an error while updating the data. Please try again.');
              }
          });
      });
  });
</script>


@endsection