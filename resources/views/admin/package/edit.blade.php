@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Add Package</h4>
                    <ol class="breadcrumb" style="display:none">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">CMS</a></li> -->
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Package</a></li>
                        <li class="breadcrumb-item active">Add Package</li>
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
                            <h4 class="mt-0 header-title">Add Package Form</h4>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                            <form action="{{ route('packages.update', $package->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') <!-- Use PUT method to indicate it's an update request -->
                                
                                <div class="form-group">
                                    <label for="package_name">Package Name</label>
                                    <input type="text" name="package_name" value="{{ old('package_name', $package->package_name) }}" class="form-control">
                                </div>
                                
                                <div class="form-group">
                                    <label for="package_name">State Name</label>
                                    <input type="text" name="state_id" value="{{ old('state_id', $package->state_id) }}" class="form-control">
                                </div>
                            
                                <div class="form-group">
                                    <label for="package_name">City Name</label>
                                    <input type="text" name="city_id" value="{{ old('city_id', $package->city_id) }}" class="form-control">
                                </div>
                                
                                <div class="form-group">
                                    <label for="image">Images</label>
                                    <input type="file" name="image[]" class="form-control" multiple>
                                    <small class="form-text text-muted">Leave blank to keep existing images.</small>
                                    @if($package->image)
                                        <div>
                                            @foreach(json_decode($package->image) as $key => $image)
                                                <div class="image-item">
                                                    <img src="{{ asset('storage/' . $image) }}" alt="Package Image" width="100" height="100">
                                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm remove-image" data-image="{{ $image }}" data-key="{{ $key }}">Remove</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            
                                <div class="form-group">
                                    <label for="video">Videos</label>
                                    <input type="file" name="video[]" class="form-control" multiple>
                                    <small class="form-text text-muted">Leave blank to keep existing videos.</small>
                                    @if($package->video)
                                        <div>
                                            @foreach(json_decode($package->video) as $video)
                                                <video width="150" controls>
                                                    <source src="{{ asset('storage/' . $video) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <label for="text_description">Text Description</label>
                                    <textarea name="text_description" class="form-control">{{ old('text_description', $package->text_description) }}</textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="text_description_2">Additional Text Description</label>
                                    <textarea name="text_description_2" class="form-control">{{ old('text_description_2', $package->text_description_2) }}</textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Update Package</button>
                            </form>
                            
                            <!-- Hidden input to store deleted images -->
                            <input type="hidden" name="deleted_images" id="deleted_images" value="">
                            
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
        <!-- end page content-->
    </div> <!-- container-fluid -->
</div> <!-- content -->

<script>
    // JavaScript to handle the image removal
    document.querySelectorAll('.remove-image').forEach(function(button) {
        button.addEventListener('click', function() {
            var image = this.getAttribute('data-image'); // Get the image path
            var key = this.getAttribute('data-key'); // Get the key of the image in the array

            // Get the current deleted images (from the hidden input field)
            var deletedImages = document.getElementById('deleted_images').value;

            // Add the image to the deleted images list (separated by commas)
            if (deletedImages) {
                deletedImages += ',' + image;
            } else {
                deletedImages = image;
            }

            // Update the hidden input field with the new deleted images list
            document.getElementById('deleted_images').value = deletedImages;

            // Remove the image from the form
            this.closest('.image-item').remove(); // Removes the image from the displayed form
        });
    });
</script>
@endsection