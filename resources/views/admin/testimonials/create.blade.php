@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Add Testimonials</h4>
                    <ol class="breadcrumb" style="display:none">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">CMS</a></li> -->
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Testimonials</a></li>
                        <li class="breadcrumb-item active">Add Testimonials</li>
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
                            <h4 class="mt-0 header-title">Add Testimonials Form</h4>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                            <form action="{{route('testimonials_crete')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">

                                     <div class="col-sm-12 mt-2">
                                        <select class="form-control" name="type" id="type" required>
                                            <option value="">Select Type</option>
                                            <option value="Package">Package</option>
                                            <option value="Hotel">Hotel</option>
                                            <option value="Taxi Booking">Taxi Booking</option>
                                            <option value="Safari">Safari</option>
                                            <option value="Guide">Guide</option>
                                        </select>
                                        <div class="form-floating">
                                            @error('type')
                                            <div style="color:red">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 mt-5">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" type="text" value="" id="title" name="title" placeholder="Enter Vehicle type" required>
                                            <label for="name">Enter Title &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('title')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group row">
                                      <div class="col-sm-12 mt-3">
                                        <label class="form-label" for="power">Image &nbsp;<span style="color:red;">*</span></label>
                                        <input type="file" class="form-control" type="text" value="" id="image" name="image" placeholder="Enter Vehicle type" required>
                                        @error('image')
                                        <div style="color:red">{{$message}}</div>
                                    @enderror
                                    </div>


                                     <div class="col-sm-12 mt-5">
                                            <label class="form-label" for="power">Text Description &nbsp;<span style="color:red;">*</span></label>
                                            <textarea class="form-control" name="description" id="text_description" required>{{ old('text_description') }}</textarea>
                                            @error('text_description')
                                                <div style="color:red">{{$message}}</div>
                                            @enderror
                                        </div>

                                </div>

                                <div class="form-group row">
                                    <div class="form-group">
                                        <div class="w-100 text-center">
                                            <button type="submit" style="margin-top: 10px;" class="btn btn-danger"><i class="fa fa-user"></i> Submit</button>
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

<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>



<script>
    CKEDITOR.replace('text_description', {
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

    // Initialize CKEditor for long description
    CKEDITOR.replace('text_description_2', {
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
