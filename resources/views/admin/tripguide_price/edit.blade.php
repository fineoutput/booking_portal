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
                    <h4 class="page-title">Edit Trip Guide</h4>
                    <ol class="breadcrumb" style="display:none">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">CMS</a></li> -->
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Trip Guide</a></li>
                        <li class="breadcrumb-item active">Edit Trip Guide</li>
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
                            <h4 class="mt-0 header-title">Edit Trip Guide Form</h4>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                          <form action="{{ route('tripguide_price.update', $guide->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') {{-- Required for PUT request --}}

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input class="form-control" type="number" id="price_1_to_4" name="price_1_to_4"
                                                value="{{ old('price_1_to_4', $guide->price_1_to_4) }}" placeholder="Enter 1 To 4 Pax Price" required>
                                            <label for="price_1_to_4">1 To 4 Pax Price &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('price_1_to_4')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input class="form-control" type="number" id="price_5" name="price_5"
                                                value="{{ old('price_5', $guide->price_5) }}" placeholder="Enter 5 Pax Price" required>
                                            <label for="price_5">5 Pax Price &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('price_5')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input class="form-control" type="number" id="price_6" name="price_6"
                                                value="{{ old('price_6', $guide->price_6) }}" placeholder="Enter 6 Pax Price" required>
                                            <label for="price_6">6 Pax Price &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('price_6')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input class="form-control" type="number" id="price_6_to_10" name="price_6_to_10"
                                                value="{{ old('price_6_to_10', $guide->price_6_to_10) }}" placeholder="Enter 6 to 10 Pax Price" required>
                                            <label for="price_6_to_10">6 To 10 Pax Price &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('price_6_to_10')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="w-100 text-center">
                                        <button type="submit" style="margin-top: 10px;" class="btn btn-danger">
                                            <i class="fa fa-save"></i> Update
                                        </button>
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


@endsection