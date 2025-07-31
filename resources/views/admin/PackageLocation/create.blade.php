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
                    <div class="col-sm-5">
                        <label class="form-label">Location <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" name="locations[]" value="{{ old('locations.' . $index, $locCost->location) }}" required>
                    </div>

                    <div class="col-sm-5">
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
                <div class="col-sm-5">
                    <label class="form-label">Location <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" name="locations[]" required>
                </div>

                <div class="col-sm-5">
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
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="locations[]" required placeholder="Location">
                    </div>
                    <div class="col-sm-5">
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

@endsection