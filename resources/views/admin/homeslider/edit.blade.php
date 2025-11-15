@extends('admin.base_template')
@section('main')
<!-- Start content -->

<style>
  
    form {
      margin-top: 20px;
    }
    
    select {
      width: 400px;
    }
    </style>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Add Slider Edit</h4>
                    <ol class="breadcrumb" style="display:none">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">CMS</a></li> -->
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Slider Edit </a></li>
                        <li class="breadcrumb-item active">Add Slider</li>
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
                            <h4 class="mt-0 header-title">Add Slider Form</h4>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                            <form action="{{ route('home_slider.update', $slider->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') <!-- Specify the form method as PUT to update the data -->
                                
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <select class="form-control" name="type" id="type" required>
                                            <option value="">Select Type</option>

                                            <option value="Banner" {{ $slider->type == 'Banner' ? 'selected' : '' }}>Banner</option>

                                            <option value="Offer" {{ $slider->type == 'Offer' ? 'selected' : '' }}>Offer</option>

                                            <option value="Bottom" {{ $slider->type == 'Bottom' ? 'selected' : '' }}>Bottom</option>


                                        </select>
                                        @error('type')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <select class="form-control" name="type_2" id="type_2" required>
                                            <option value="">Select Type 2</option>

                                            <option value="taxi" {{ $slider->type == 'taxi' ? 'selected' : '' }}>Taxi</option>

                                            <option value="guide" {{ $slider->type == 'guide' ? 'selected' : '' }}>Guide</option>

                                            <option value="package" {{ $slider->type == 'package' ? 'selected' : '' }}>Package</option>

                                            <option value="safari" {{ $slider->type == 'safari' ? 'selected' : '' }}>safari</option>

                                            <option value="hotel" {{ $slider->type == 'hotel' ? 'selected' : '' }}>Hotel</option>


                                        </select>
                                        @error('type')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <div class="col-sm-4">
                                        <label for="state">Select Image</label>
                                        <input class="form-control" type="file" name="image">
                                        @error('image')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                        <img src="{{ asset($slider->image) }}" width="50" height="50" alt="">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="state">Select App Image</label>
                                        <input class="form-control" type="file" name="Appimage">
                                        @error('Appimage')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror
                                        <img src="{{ asset($slider->Appimage) }}" width="50" height="50" alt="">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="video">Select Video</label>
                                        <input class="form-control" type="file" name="video" accept="video/*">
                                        @error('video')
                                            <div style="color:red">{{ $message }}</div>
                                        @enderror

                                        @if(!empty($slider->video))
                                            <video width="150" height="100" controls>
                                                <source src="{{ asset($slider->video) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        @endif
                                    </div>

                                </div>
                            
                                <div class="form-group row">
                                    <div class="form-group">
                                        <div class="w-100 text-center">
                                            <button type="submit" style="margin-top: 10px;" class="btn btn-danger"><i class="fa fa-user"></i> Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
        <!-- end page content-->
    </div> <!-- container-fluid -->
</div> <!-- content -->


<link rel="stylesheet" href="https://harvesthq.github.io/chosen/chosen.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<script>
    document.getElementById('output').innerHTML = location.search;
    $(".chosen-select").chosen();
</script>

<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description', {
        toolbar: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList'] },
            { name: 'insert', items: ['Link', 'Unlink'] },
            { name: 'styles', items: ['Format', 'FontSize'] },
            { name: 'colors', items: ['TextColor', 'BGColor'] },
            { name: 'tools', items: ['Maximize'] }
        ],
        height: 200
    });

    CKEDITOR.replace('long_description', {
        toolbar: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList'] },
            { name: 'insert', items: ['Link', 'Unlink', 'Image'] },
            { name: 'styles', items: ['Format', 'FontSize'] },
            { name: 'colors', items: ['TextColor', 'BGColor'] },
            { name: 'tools', items: ['Maximize'] }
        ],
        height: 300
    });
</script>
@endsection