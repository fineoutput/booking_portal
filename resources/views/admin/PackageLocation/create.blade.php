{{-- @extends('admin.base_template')

@section('main')


<div class="content-wrapper">
  <section class="content-header">
    <h1>Edit Location</h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Edit Location</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Edit Location</h3>
          </div>
          

          @if(session('message'))
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-check"></i> Alert!</h4>
              {{ session('message') }}
            </div>
          @endif

          @if(session('emessage'))
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-ban"></i> Alert!</h4>
              {{ session('emessage') }}
            </div>
          @endif

          <div class="panel-body">
            <div class="col-lg-10">

     <form method="POST" action="{{ route('location_cost', $id) }}">
    @csrf

    <div id="location-cost-wrapper">
        @if(isset($locationCosts) && $locationCosts->count())
            @foreach($locationCosts as $index => $locCost)
                <div class="form-group row location-cost-row">
                    <div class="col-sm-3">
                        <label class="form-label">Location <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" name="locations[]" value="{{ old('locations.' . $index, $locCost->location) }}" required>
                    </div>

                  <div class="col-sm-3">
                    <label class="form-label">Vehicle <span style="color:red;">*</span></label>
                    <select name="vehicle[]" class="form-control" required>
                        @php
                            $vehicles = [
                                'hatchback_cost' => 'Hatchback',
                                'sedan_cost' => 'Sedan',
                                'economy_suv_cost' => 'Economy SUV',
                                'luxury_suv_cost' => 'Premium SUV',
                                'traveller_mini_cost' => 'Tempo Traveller(8-16 Seat)',
                                'traveller_big_cost' => 'Tempo Traveller(17-25 Seat)',
                                'premium_traveller_cost' => 'Urbania(12-17 Seat)',
                                'ac_coach_cost' => 'Luxury Bus',
                                'bus_nonac_cost' => 'Deluxe Bus',
                            ];
                        @endphp

                        @foreach ($vehicles as $value => $label)
                            <option value="{{ $value }}"
                                {{ old('vehicle.' . $index, $locCost->vehicle ?? '') === $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                    <div class="col-sm-3">
                        <label class="form-label">Cost <span style="color:red;">*</span></label>
                        <input type="number" class="form-control" name="costs[]" value="{{ old('costs.' . $index, $locCost->cost) }}" required>
                    </div>

                    <div class="col-sm-2 d-flex align-items-end">
                        @if($index === 0)
                            <button type="button" class="btn btn-primary btn-add-more">Add More</button>
                        @else
                            <button type="button" class="btn btn-danger btn-remove">Remove</button>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <!-- No existing data, show one blank row -->
            <div class="form-group row location-cost-row">
                <div class="col-sm-3">
                    <label class="form-label">Location <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" name="locations[]" required>
                </div>


                                <div class="col-sm-3">
                    <label class="form-label">Vehicle <span style="color:red;">*</span></label>
                    <select name="vehicle[]" class="form-control" id="">
                      <option value="hatchback_cost">Hatchback</option>
                      <option value="sedan_cost">Sedan</option>
                      <option value="economy_suv_cost">Economy SUV</option>
                      <option value="luxury_suv_cost">Premium SUV</option>
                      <option value="traveller_mini_cost">Tempo Traveller(8-16 Seat)</option>
                      <option value="traveller_big_cost">Tempo Traveller(17-25 Seat)</option>
                      <option value="premium_traveller_cost">Urbania(12-17 Seat)</option>
                      <option value="ac_coach_cost">Luxury Bus</option>
                      <option value="bus_nonac_cost">Deluxe Bus</option>
                    </select>
                </div>


                <div class="col-sm-3">
                    <label class="form-label">Cost <span style="color:red;">*</span></label>
                    <input type="number" class="form-control" name="costs[]" required>
                </div>



                <div class="col-sm-2 d-flex align-items-end">
                    <button type="button" class="btn btn-primary btn-add-more">Add More</button>
                </div>
            </div>
        @endif
    </div>

    <div class="form-group">
        <div class="w-100 text-center mt-3">
            <button type="submit" class="btn btn-danger"><i class="fa fa-user"></i> Submit</button>
        </div>
    </div>
</form>


            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const wrapper = document.getElementById('location-cost-wrapper');

        // Add more button click
        wrapper.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('btn-add-more')) {
                const newRow = document.createElement('div');
                newRow.classList.add('form-group', 'row', 'location-cost-row');
                newRow.innerHTML = `
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="locations[]" required placeholder="Location">
                    </div>
                      <div class="col-sm-3">
                    <label class="form-label">Vehicle <span style="color:red;">*</span></label>
                    <select name="vehicle[]" class="form-control" id="">
                      <option value="hatchback_cost">Hatchback</option>
                      <option value="sedan_cost">Sedan</option>
                      <option value="economy_suv_cost">Economy SUV</option>
                      <option value="luxury_suv_cost">Premium SUV</option>
                      <option value="traveller_mini_cost">Tempo Traveller(8-16 Seat)</option>
                      <option value="traveller_big_cost">Tempo Traveller(17-25 Seat)</option>
                      <option value="premium_traveller_cost">Urbania(12-17 Seat)</option>
                      <option value="ac_coach_cost">Luxury Bus</option>
                      <option value="bus_nonac_cost">Deluxe Bus</option>
                    </select>
                </div>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" name="costs[]" required placeholder="Cost">
                    </div>
                    <div class="col-sm-2 d-flex align-items-center">
                        <button type="button" class="btn btn-danger btn-remove">Remove</button>
                    </div>
                `;
                wrapper.appendChild(newRow);
            }

            // Remove button click
            if (e.target && e.target.classList.contains('btn-remove')) {
                e.target.closest('.location-cost-row').remove();
            }
        });
    });
</script>

@endsection --}}

@extends('admin.base_template')

@section('main')
<div class="content-wrapper">
  <section class="content-header">
    <h1>Edit Location</h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Edit Location</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Edit Location</h3>
          </div>

          @if(session('success'))
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-check"></i> Alert!</h4>
              {{ session('success') }}
            </div>
          @endif

          @if($errors->any())
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-ban"></i> Alert!</h4>
              <ul>
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <div class="panel-body">
            <div class="col-lg-10">
              <form method="POST" action="{{ route('location_cost', $id) }}">
                @csrf

                <div id="location-cost-wrapper">
                  @if(isset($locationCosts) && $locationCosts->count())
                    @php
                      $groupedLocations = $locationCosts->groupBy('location');
                    @endphp
                    @foreach($groupedLocations as $location => $costs)
                      <div class="location-group mb-4">
                        <div class="form-group row location-cost-row">
                          <div class="col-sm-3">
                            <label class="form-label">Location <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" name="locations[]" value="{{ old('locations.' . $loop->index, $location) }}" required>
                          </div>
                          <div class="col-sm-8 vehicle-group">
                            @foreach($costs as $index => $locCost)
                              <div class="vehicle-row d-flex mb-2">
                                <div class="col-sm-5">
                                  <label class="form-label">Vehicle <span style="color:red;">*</span></label>
                                  <select name="vehicles[{{$loop->parent->index}}][]" class="form-control" required>
                                    @php
                                      $vehicleOptions = [
                                        'hatchback_cost' => 'Hatchback',
                                        'sedan_cost' => 'Sedan',
                                        'economy_suv_cost' => 'Economy SUV',
                                        'luxury_suv_cost' => 'Premium SUV',
                                        'traveller_mini_cost' => 'Tempo Traveller(8-16 Seat)',
                                        'traveller_big_cost' => 'Tempo Traveller(17-25 Seat)',
                                        'premium_traveller_cost' => 'Urbania(12-17 Seat)',
                                        'ac_coach_cost' => 'Luxury Bus',
                                        'bus_nonac_cost' => 'Deluxe Bus',
                                      ];
                                    @endphp
                                    @foreach($vehicleOptions as $value => $label)
                                      <option value="{{ $value }}"
                                              {{ old('vehicles.' . $loop->parent->index . '.' . $index, $locCost->vehicle) === $value ? 'selected' : '' }}>
                                        {{ $label }}
                                      </option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="col-sm-4">
                                  <label class="form-label">Cost <span style="color:red;">*</span></label>
                                  <input type="number" class="form-control" name="costs[{{$loop->parent->index}}][]" value="{{ old('costs.' . $loop->parent->index . '.' . $index, $locCost->cost) }}" required>
                                </div>
                                <div class="col-sm-2 d-flex align-items-end">
                                  @if($index !== 0)
                                    <button type="button" class="btn btn-danger btn-remove-vehicle">Remove</button>
                                  @endif
                                </div>
                              </div>
                            @endforeach
                            <div class="row">
                              <div class="col-sm-6">
                                <button type="button" class="btn btn-primary btn-add-vehicle mt-2">Add Vehicle</button>
                              </div>
                              <div class="col-sm-6 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-remove-location">Remove</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  @else
                    <div class="location-group mb-4">
                      <div class="form-group row location-cost-row">
                        <div class="col-sm-3">
                          <label class="form-label">Location <span style="color:red;">*</span></label>
                          <input type="text" class="form-control" name="locations[]" required>
                        </div>
                        <div class="col-sm-8 vehicle-group">
                          <div class="vehicle-row d-flex mb-2">
                            <div class="col-sm-5">
                              <label class="form-label">Vehicle <span style="color:red;">*</span></label>
                              <select name="vehicles[0][]" class="form-control" required>
                                <option value="hatchback_cost">Hatchback</option>
                                <option value="sedan_cost">Sedan</option>
                                <option value="economy_suv_cost">Economy SUV</option>
                                <option value="luxury_suv_cost">Premium SUV</option>
                                <option value="traveller_mini_cost">Tempo Traveller(8-16 Seat)</option>
                                <option value="traveller_big_cost">Tempo Traveller(17-25 Seat)</option>
                                <option value="premium_traveller_cost">Urbania(12-17 Seat)</option>
                                <option value="ac_coach_cost">Luxury Bus</option>
                                <option value="bus_nonac_cost">Deluxe Bus</option>
                              </select>
                            </div>
                            <div class="col-sm-4">
                              <label class="form-label">Cost <span style="color:red;">*</span></label>
                              <input type="number" class="form-control" name="costs[0][]" required>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-6">
                              <button type="button" class="btn btn-primary btn-add-vehicle mt-2">Add Vehicle</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endif
                  <button type="button" class="btn btn-primary btn-add-location">Add New Location</button>
                </div>

                <div class="form-group">
                  <div class="w-100 text-center mt-3">
                    <button type="submit" class="btn btn-danger"><i class="fa fa-user"></i> Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const wrapper = document.getElementById('location-cost-wrapper');

  // Add new location
  wrapper.addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('btn-add-location')) {
      const index = document.querySelectorAll('.location-group').length;
      const newLocation = document.createElement('div');
      newLocation.classList.add('location-group', 'mb-4');
      newLocation.innerHTML = `
        <div class="form-group row location-cost-row">
          <div class="col-sm-3">
            <label class="form-label">Location <span style="color:red;">*</span></label>
            <input type="text" class="form-control" name="locations[]" required placeholder="Location">
          </div>
          <div class="col-sm-8 vehicle-group">
            <div class="vehicle-row d-flex mb-2">
              <div class="col-sm-5">
                <label class="form-label">Vehicle <span style="color:red;">*</span></label>
                <select name="vehicles[${index}][]" class="form-control" required>
                  <option value="hatchback_cost">Hatchback</option>
                  <option value="sedan_cost">Sedan</option>
                  <option value="economy_suv_cost">Economy SUV</option>
                  <option value="luxury_suv_cost">Premium SUV</option>
                  <option value="traveller_mini_cost">Tempo Traveller(8-16 Seat)</option>
                  <option value="traveller_big_cost">Tempo Traveller(17-25 Seat)</option>
                  <option value="premium_traveller_cost">Urbania(12-17 Seat)</option>
                  <option value="ac_coach_cost">Luxury Bus</option>
                  <option value="bus_nonac_cost">Deluxe Bus</option>
                </select>
              </div>
              <div class="col-sm-4">
                <label class="form-label">Cost <span style="color:red;">*</span></label>
                <input type="number" class="form-control" name="costs[${index}][]" required placeholder="Cost">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <button type="button" class="btn btn-primary btn-add-vehicle mt-2">Add Vehicle</button>
              </div>
              <div class="col-sm-6 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-remove-location">Remove</button>
              </div>
            </div>
          </div>
        </div>
      `;
      wrapper.insertBefore(newLocation, e.target);
    }

    // Add vehicle to existing location
    if (e.target && e.target.classList.contains('btn-add-vehicle')) {
      console.log('Add Vehicle button clicked'); // Debugging
      const locationGroup = e.target.closest('.location-group');
      const locationIndex = Array.from(document.querySelectorAll('.location-group')).indexOf(locationGroup);
      const vehicleGroup = locationGroup.querySelector('.vehicle-group');
      const newVehicle = document.createElement('div');
      newVehicle.classList.add('vehicle-row', 'd-flex', 'mb-2');
      newVehicle.innerHTML = `
        <div class="col-sm-5">
          <label class="form-label">Vehicle <span style="color:red;">*</span></label>
          <select name="vehicles[${locationIndex}][]" class="form-control" required>
            <option value="hatchback_cost">Hatchback</option>
            <option value="sedan_cost">Sedan</option>
            <option value="economy_suv_cost">Economy SUV</option>
            <option value="luxury_suv_cost">Premium SUV</option>
            <option value="traveller_mini_cost">Tempo Traveller(8-16 Seat)</option>
            <option value="traveller_big_cost">Tempo Traveller(17-25 Seat)</option>
            <option value="premium_traveller_cost">Urbania(12-17 Seat)</option>
            <option value="ac_coach_cost">Luxury Bus</option>
            <option value="bus_nonac_cost">Deluxe Bus</option>
          </select>
        </div>
        <div class="col-sm-4">
          <label class="form-label">Cost <span style="color:red;">*</span></label>
          <input type="number" class="form-control" name="costs[${locationIndex}][]" required placeholder="Cost">
        </div>
        <div class="col-sm-2 d-flex align-items-end">
          <button type="button" class="btn btn-danger btn-remove-vehicle">Remove</button>
        </div>
      `;
      vehicleGroup.insertBefore(newVehicle, vehicleGroup.querySelector('.btn-add-vehicle').parentElement.parentElement);
    }

    // Remove vehicle
    if (e.target && e.target.classList.contains('btn-remove-vehicle')) {
      console.log('Remove Vehicle button clicked'); // Debugging
      e.target.closest('.vehicle-row').remove();
    }

    // Remove location
    if (e.target && e.target.classList.contains('btn-remove-location')) {
      console.log('Remove Location button clicked'); // Debugging
      e.target.closest('.location-group').remove();
    }
  });
});
</script>
@endsection