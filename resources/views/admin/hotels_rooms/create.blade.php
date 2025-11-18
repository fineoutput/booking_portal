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
                    <h4 class="page-title">Add Room</h4>
                    <ol class="breadcrumb" style="display:none">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">CMS</a></li> -->
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Room</a></li>
                        <li class="breadcrumb-item active">Add Room</li>
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
                            <h4 class="mt-0 header-title">Add Hotel Form</h4>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                            <form action="{{route('store_hotels_room',$hotels->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" type="text" value="" id="title" name="title" placeholder="Enter title" required>
                                            <label for="name">Enter Title &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('title')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                             
                                        
                                        <div class="col-sm-6"><br>
                                            <label class="form-label" style="margin-left: 10px" for="power">Select Meal Multipal</label>
                                            <div id="output"></div>
                                            <select data-placeholder="" name="meal_plan[]" multiple class="chosen-select">
                                                <option value="meal_plan_only_room">Meal Plan (Only Room)</option>
                                                <option value="meal_plan_breakfast">Meal Plan (Breakfast)</option>
                                                <option value="meal_plan_all_meals">Meal Plan (All meals)</option>
                                                <option value="meal_plan_breakfast_lunch_dinner">Meal Plan (Breakfast + lunch/dinner)</option>
                                            </select>
                                            @error('meal_plan')
                                                <div style="color:red;">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-sm-6"><br>
                                            <label class="form-label" style="margin-left: 10px" for="power">Nearby within Walking Distance</label>
                                            <div id="output"></div>
                                            <select data-placeholder="" name="nearby[]" multiple class="chosen-select">
                                                <option value="Public transport within 1 km">Public transport within 1 km</option>
                                                <option value="Shopping centers within 1 km">Shopping centers within 1 km</option>
                                            </select>
                                            @error('nearby')
                                                <div style="color:red;">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-sm-6"><br>
                                            <label class="form-label" style="margin-left: 10px" for="power">Locality</label>
                                            <div id="output"></div>
                                            <select data-placeholder="" name="locality[]" multiple class="chosen-select">
                                                <option value="Other Popular Areas">Other Popular Areas</option>
                                                <option value="Near Popular Attractions">Near Popular Attractions</option>
                                                <option value="Near Transit Hub(s)">Near Transit Hub(s)</option>
                                            </select>
                                            @error('locality')
                                                <div style="color:red;">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-sm-6"><br>
                                            <label class="form-label" style="margin-left: 10px" for="power">Chains</label>
                                            <div id="output"></div>
                                            <select data-placeholder="" name="chains[]" multiple class="chosen-select">
                                                <option value="Marriott, Westin & Le Meridien">Marriott, Westin & Le Meridien</option>
                                                <option value="Moustache">Moustache</option>
                                                <option value="Oyo Hotels">Oyo Hotels</option>
                                                <option value="Sarovar">Sarovar</option>
                                                <option value="StayVista">StayVista</option>
                                                <option value="Sterling Holiday resorts">Sterling Holiday resorts</option>
                                                <option value="Taj">Taj</option>
                                                <option value="Treebo Hotels">Treebo Hotels</option>
                                                <option value="Zostel">Zostel</option>
                                            </select>
                                            @error('chains')
                                                <div style="color:red;">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-sm-6"><br>
                                            <label class="form-label" style="margin-left: 10px" for="power">Hotel Amenities</label>
                                            <div id="output"></div>
                                            <select data-placeholder="" name="hotel_amenities[]" multiple class="chosen-select">
                                                <option value="Room Service"> Room Service</option>
                                                <option value="Balcony/Terrace">Balcony/Terrace</option>
                                                <option value="Barbeque">Barbeque</option>
                                                <option value="Cafe">Cafe</option>
                                                <option value="EV Charging Station">EV Charging Station</option>
                                                <option value="Restaurant">Restaurant</option>
                                                <option value="Bar">Bar</option>
                                                <option value="Parking">Parking</option>
                                                <option value="Caretaker">Caretaker</option>
                                                <option value="Bonfire">Bonfire</option>
                                                <option value="Kitchenette">Kitchenette</option>
                                                <option value="Elevator/Lift">Elevator/Lift</option>
                                                <option value="Indoor Games">Indoor Games</option>
                                                <option value="Living Room">Living Room</option>
                                            </select>
                                            @error('hotel_amenities')
                                                <div style="color:red;">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="col-sm-6"><br>
                                            <label class="form-label" style="margin-left: 10px" for="power">Room Amenities</label>
                                            <div id="output"></div>
                                            <select data-placeholder="" name="room_amenities[]" multiple class="chosen-select">
                                                <option value="Fireplace">Fireplace</option>
                                                <option value="Interconnected Room">Interconnected Room</option>
                                                <option value="Bathtub">Bathtub</option>
                                                <option value="Kitchenette">Kitchenette</option>
                                                <option value="Smoking Room">Smoking Room</option>
                                                <option value="Private Pool">Private Pool</option>
                                                <option value="Balcony">Balcony</option>
                                                <option value="Cook & Butler Service">Cook & Butler Service</option>
                                                <option value="Heater">Heater</option>
                                                <option value="Jacuzzi">Jacuzzi</option>
                                                <option value="Living Area">Living Area</option>
                                            </select>
                                            @error('room_amenities')
                                                <div style="color:red;">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="col-sm-6"><br>
                                            <label class="form-label" style="margin-left: 10px" for="power">House Rules</label>
                                            <div id="output"></div>
                                            <select data-placeholder="" name="house_rules[]" multiple class="chosen-select">
                                                <option value="Smoking Allowed">Smoking Allowed</option>
                                                <option value="Unmarried Couples Allowed">Unmarried Couples Allowed</option>
                                                <option value="Pets Allowed">Pets Allowed</option>
                                                <option value="Alcohol Allowed">Alcohol Allowed</option>
                                                <option value="Non Veg Allowed">Non Veg Allowed</option>
                                            </select>
                                            @error('house_rules')
                                                <div style="color:red;">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6"><br>
                                            <label class="form-label" style="margin-left: 10px" for="power">Select Multipal Image</label>
                                            <input class="form-control" style="margin-left: 10px" type="file" id="images" name="images[]" multiple>
                                        </div>
                                       
                                    </div>

                                     <div class="col-sm-12 mt-3">
                                            <label class="form-label" for="power"> Description &nbsp;<span style="color:red;">*</span></label>
                                            <textarea class="form-control" name="description" id="description" required>{{ old('description') }}</textarea>
                                            @error('description')
                                                <div style="color:red">{{$message}}</div>
                                            @enderror
                                        </div>

                                        
                                    <div class="col-sm-4 mt-3">
                                    <label class="form-label" for="power">
                                        Show Front <span style="color:red;">*</span>
                                    </label>

                                    <select class="form-control" name="show_front" id="">
                                        <option selected disabled value="">Select</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>

                                    @error('show_front')
                                        <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>


                                    <div class="form-group">
                                        <div class="w-100 text-center">
                                            <button type="submit" style="margin-top: 10px;" class="btn btn-danger"><i class="fa fa-user"></i> Submit</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </div> 
</div> 

<link rel="stylesheet" href="https://harvesthq.github.io/chosen/chosen.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<script>
    document.getElementById('output').innerHTML = location.search;
    $(".chosen-select").chosen();
</script>

<script>

    CKEDITOR.replace('description', {
        toolbar: [
            { name: 'basicstyles', items: ['Italic', 'Underline', 'Strike', 'RemoveFormat'] },
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