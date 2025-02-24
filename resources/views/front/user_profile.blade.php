@extends('front.common.app')
@section('title','Agent Profile')
@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4 suther">Agent Profile</h2>
    
    <!-- Navigation Tabs -->
    <ul class="nav nav-tabs suther" id="agentProfileTabs">
        <li class="nav-item suther">
            <a class="nav-link active suther" style="color: #000;" href="#profile" data-bs-toggle="tab">Profile</a>
        </li>
        <li class="nav-item suther">
            <a class="nav-link suther" style="color: #000;" href="#bookings" data-bs-toggle="tab">Bookings</a>
        </li>
        <li class="nav-item suther">
            <a class="nav-link suther" style="color: #000;" href="#wallet" data-bs-toggle="tab">Wallet</a>
        </li>
        <li class="nav-item suther">
            <a class="nav-link suther" style="color: #000;" href="#policies" data-bs-toggle="tab">Policies</a>
        </li>
        <li class="nav-item suther">
            <a class="nav-link suther" style="color: #000;" href="#terms" data-bs-toggle="tab">T&C</a>
        </li>
    </ul>
    
    <!-- Tab Content -->
    <div class="tab-content mt-3 suther">
        <!-- Profile Tab -->
        <div class="tab-pane fade show active suther" id="profile">
            <h5 class="fw-bold suther">Profile Details</h5>
            <p class="suther">Here you can manage and update your personal details.</p>
            <!-- Profile Details Section -->
            <div class="row suther">
                <div class="col-md-6 suther">
                    <label class="fw-bold suther">Name:</label>
                    <p class="suther">{{$user->name ?? ''}}</p>
                </div>
                <div class="col-md-6 suther">
                    <label class="fw-bold suther">Email:</label>
                    <p class="suther">{{$user->email ?? ''}}</p>
                </div>
                <div class="col-md-6 suther">
                    <label class="fw-bold suther">Phone:</label>
                    <p class="suther">{{$user->number ?? ''}}</p>
                </div>
                <div class="col-md-6 suther">
                    <label class="fw-bold suther">Business Name:</label>
                    <p class="suther">{{$user->business_name ?? ''}}</p>
                </div>
                <div class="col-md-6 suther">
                    <label class="fw-bold suther">GST Number:</label>
                    <p class="suther">{{$user->GST_number ?? ''}}</p>
                </div>
                <div class="col-md-6 suther">
                    <label class="fw-bold suther">State:</label>
                    <p class="suther">{{ optional($user->state)->state_name ?? '' }}</p>
                </div>
                <div class="col-md-6 suther">
                    <label class="fw-bold suther">City:</label>
                    <p class="suther">{{ optional($user->cities)->city_name ?? '' }}</p>
                </div>
                <div class="col-md-6 suther">
                    <label class="fw-bold suther">Aadhar Image Front:</label>
                    <p class="suther">
                        @if($user->aadhar_image)
                            <img src="{{ asset('storage/' . $user->aadhar_image) }}" alt="Aadhar Image" style="max-width: 50px; max-height: 50px;">
                        @else
                            N/A
                        @endif
                    </p>
                </div>
                <div class="col-md-6 suther">
                    <label class="fw-bold suther">Aadhar Image Back:</label>
                    <p class="suther">
                        @if($user->aadhar_image_back)
                            <img src="{{ asset('storage/' . $user->aadhar_image_back) }}" alt="Aadhar Image" style="max-width: 50px; max-height: 50px;">
                        @else
                            N/A
                        @endif
                    </p>
                </div>
                <div class="col-md-6 suther">
                    <label class="fw-bold suther">Pancard Image:</label>
                    <p class="suther">
                        @if($user->pan_image)
                            <img src="{{ asset('storage/' . $user->pan_image) }}" alt="Aadhar Image" style="max-width: 50px; max-height: 50px;">
                        @else
                            N/A
                        @endif
                    </p>
                </div>
                <div class="col-md-6 suther">
                    <label class="fw-bold suther">Logo:</label>
                    <p class="suther">
                        @if($user->logo)
                            <img src="{{ asset('storage/' . $user->logo) }}" alt="Aadhar Image" style="max-width: 50px; max-height: 50px;">
                        @else
                            N/A
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Bookings Tab -->
        <div class="tab-pane fade suther" id="bookings">
            <h5 class="fw-bold suther">Package Bookings</h5>
            <p class="suther">View your booking history and manage reservations.</p>
            <!-- Bookings Details Section -->
            <div class="table-responsive ">
            <table class="table table-bordered suther">
                <thead class="suther">
                    <tr class="suther">
                        <th class="suther">#</th>
                        <th class="suther">Booking ID</th>
                        <th class="suther">Package Name</th>
                        <th class="suther">Date</th>
                        <th class="suther">Status</th>
                        <th class="suther">Action</th>
                        <th class="suther">Tourist List</th>
                        <th class="suther">Request Upgrade</th>
                    </tr>
                </thead>
                <tbody class="suther">
   @foreach($booking as $key => $value)
<tr class="suther">
    <td class="suther">{{$key+1}}</td>
    <td class="suther">#{{$value->id ?? ''}}</td>
    <td class="suther">{{$value->package->package_name ?? ''}}</td>
    <td class="suther">{{ \Carbon\Carbon::parse($value->created_at)->format('d F Y') ?? '' }}</td>
    <td class="suther">
        @if($value->status == 0)
        Pending
        @else
        Complete
        @endif
    </td>
    <td class="suther">
        <!-- Open the modal with the corresponding Booking ID -->
        <button style="width: 100%;" class="btn btn-primary suther" data-bs-toggle="modal" data-bs-target="#packageDetailsModal{{ $value->id }}" onclick="setBookingId({{ $value->id }})">Enter Details</button>

    </td>
    <td class="suther">
        <button class="btn btn-secondary suther" data-bs-toggle="modal" data-bs-target="#touristListModal{{ $value->id }}" onclick="showTouristList(1)">View List</button>
    </td>
    <td class="suther">
        <button class="btn btn-warning suther" data-bs-toggle="modal" data-bs-target="#upgradeRequestModal">Request Upgrade</button>
    </td>
</tr>

<!-- Modal for Tourist Details -->

<div class="modal fade suther" id="touristListModal{{ $value->id }}" tabindex="-1" aria-labelledby="touristListModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg suther">
        <div class="modal-content suther">
            <div class="modal-header suther">
                <h5 class="modal-title suther" id="touristListModalLabel">Tourist List for Booking #{{ $value->id }}</h5>
                <button type="button" class="btn-close suther" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body suther">
                <div class="suther">
                    @if($value->tourists->isEmpty())
                        <p>No tourists added for this booking.</p>
                    @else
                        @foreach($value->tourists as $tourist)
                            <div class="mb-3 suther">
                                <p><strong>Tourist:</strong></p>
                                <p>Name: {{ $tourist->name }}</p>
                                <p>Age: {{ $tourist->age }}</p>
                                <p>Phone: {{ $tourist->phone }}</p>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade suther" id="packageDetailsModal{{ $value->id }}" tabindex="-1" aria-labelledby="packageDetailsModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg suther">
        <div class="modal-content suther">
            <div class="modal-header suther">
                <h5 class="modal-title suther" id="packageDetailsModalLabel">Enter Package Details</h5>
                <button type="button" class="btn-close suther" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form enctype="multipart/form-data" method="POST" action="{{ route('saveTouristDetails') }}" class="suther" id="touristForm">
                @csrf
                <div class="modal-body suther">
                    <!-- Hidden Booking ID Field -->
                    <input type="hidden" id="bookingIdss" name="booking_id" value="{{ $value->id ?? ''}}">

                    <h6 class="fw-bold suther">Tourists Information</h6>
                    <div id="touristContainer" class="mb-3 suther">
                        <!-- Template for Tourist Details -->
                        <div class="tourist-section suther mb-4">
                            <h6 class="fw-bold suther">Tourist 1</h6>
                            <div class="row mb-3 suther">
                                <div class="col-md-6 suther">
                                    <label for="touristName" class="form-label suther">Name</label>
                                    <input type="text" class="form-control suther touristName" name="tourist[1][name]" placeholder="Enter Name">
                                    {{-- <input type="hidden" name="booking_id" > --}}
                                </div>
                                <div class="col-md-6 suther">
                                    <label for="touristAge" class="form-label suther">Age</label>
                                    <input type="number" class="form-control suther touristAge" name="tourist[1][age]" placeholder="Enter Age">
                                </div>
                            </div>
                            <div class="row mb-3 suther">
                                <div class="col-md-6 suther">
                                    <label for="touristPhone" class="form-label suther">Phone No.</label>
                                    <input type="text" class="form-control suther touristPhone" name="tourist[1][phone]" placeholder="Enter Phone No.">
                                </div>
                                <div class="col-md-6 suther">
                                    <label for="aadharUploadFront" class="form-label suther">Aadhaar Card (Front)</label>
                                    <input id="aadhar_front" type="file" class="form-control suther touristAadharFront" name="tourist[1][aadhar_front]">
                                </div>
                            </div>
                            <div class="row mb-3 suther">
                                <div class="col-md-6 suther">
                                    <label for="aadharUploadBack" class="form-label suther">Aadhaar Card (Back)</label>
                                    <input id="aadhar_back" type="file" class="form-control suther touristAadharBack" name="tourist[1][aadhar_back]">
                                </div>
                            </div>
                            {{-- <button type="button" class="btn btn-danger suther remove-tourist-btn">Remove Tourist</button> --}}
                        </div>
                    </div>
                    
                    {{-- <button type="button" class="btn btn-primary suther" id="addTouristBtn">Add Another Tourist</button> --}}

                    <h6 class="fw-bold suther mt-4">Additional Information</h6>
                    <div class="mb-3 suther">
                        <label for="additionalInfo" class="form-label suther">Details</label>
                        <textarea class="form-control suther" id="additionalInfo" name="additional_info" rows="2" placeholder="Enter Additional Information"></textarea>
                    </div>
                </div>
                
                <div class="modal-footer suther">
                    <button type="button" class="btn btn-secondary suther" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary suther">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

                </tbody>
            </table>
            </div>
        </div>

        <!-- Wallet Tab -->
        <!-- Wallet Tab -->
<div class="tab-pane fade suther" id="wallet">
    <h5 class="fw-bold suther">Wallet</h5>
    <p class="suther">Manage your wallet balance and transactions.</p>
    <!-- Wallet Details Section -->
    <div class="row suther">
        <div class="col-md-6 suther">
            <label class="fw-bold suther">Balance:</label>
            <p class="suther">$500.00</p>
        </div>
        <div class="col-md-6 suther">
            <label class="fw-bold suther">Last Transaction:</label>
            <p class="suther">+ $200.00 on 2024-12-15</p>
        </div>
    </div>
    <div class="mt-3">
        <button class="btn btn-primary suther" data-bs-toggle="modal" data-bs-target="#refundRechargeModal">Refund/Recharge</button>
    </div>
</div>

<!-- Refund/Recharge Modal -->
<div class="modal fade suther" id="refundRechargeModal" tabindex="-1" aria-labelledby="refundRechargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg suther">
        <div class="modal-content suther">
            <div class="modal-header suther">
                <h5 class="modal-title suther" id="refundRechargeModalLabel">Refund/Recharge Wallet</h5>
                <button type="button" class="btn-close suther" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body suther">
                <form class="suther">
                    <h6 class="fw-bold suther">Refund/Recharge Details</h6>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3 suther">
                                <label for="transactionType" class="form-label suther">Transaction Type</label>
                                <select class="form-control suther" id="transactionType">
                                    <option value="refund">Refund</option>
                                    <option value="recharge">Recharge</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3 suther">
                                <label for="amount" class="form-label suther">Amount</label>
                                <input type="number" class="form-control suther" id="amount" placeholder="Enter Amount">
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="mb-3 suther">
                        <label for="notes" class="form-label suther">Notes</label>
                        <textarea class="form-control suther" id="notes" rows="3" placeholder="Enter Notes (Optional)"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success suther">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


        <!-- Policies Tab -->
        <div class="tab-pane fade suther" id="policies">
            <h5 class="fw-bold suther">Policies</h5>
            <p class="suther">Review and manage your policies.</p>
            <ul class="suther">
                <li class="suther">Policy 1: Lorem ipsum dolor sit amet.</li>
                <li class="suther">Policy 2: Consectetur adipiscing elit.</li>
                <li class="suther">Policy 3: Sed do eiusmod tempor incididunt.</li>
            </ul>
        </div>

        <!-- Terms & Conditions Tab -->
        <div class="tab-pane fade suther" id="terms">
            <h5 class="fw-bold suther">Terms & Conditions</h5>
            <p class="suther">Read the terms and conditions associated with your account.</p>
            <p class="suther">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vehicula justo at urna facilisis, vel tempus libero fermentum.</p>
        </div>
    </div>
</div>


<!-- Package Details Modal -->


<div class="modal fade suther" id="upgradeRequestModal" tabindex="-1" aria-labelledby="upgradeRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg suther">
        <div class="modal-content suther">
            <div class="modal-header suther">
                <h5 class="modal-title suther" id="upgradeRequestModalLabel">Request Upgrade</h5>
                <button type="button" class="btn-close suther" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body suther">
                <form class="suther">
                    <h6 class="fw-bold suther">Upgrade Request Details</h6>
                    <div class="mb-3 suther">
                        <label for="bookingId" class="form-label suther">Booking ID</label>
                        <input type="text" class="form-control suther" id="bookingId" placeholder="Enter Booking ID">
                    </div>
                    <div class="mb-3 suther">
                        <label for="upgradeDetails" class="form-label suther">Upgrade Details</label>
                        <textarea class="form-control suther" id="upgradeDetails" rows="3" placeholder="Enter Upgrade Details"></textarea>
                    </div>
                    <div class="mb-3 suther">
                        <label for="upgradeNotes" class="form-label suther">Notes</label>
                        <textarea class="form-control suther" id="upgradeNotes" rows="3" placeholder="Enter Notes (Optional)"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success suther">Submit Request</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

function setBookingId(bookingId) {
    document.getElementById('bookingIdss').value = bookingId;
}

    
    $('#touristForm').submit(function(e) {
    e.preventDefault(); // Prevent default form submission

    let formData = new FormData(this); // Collect form data including files

    $.ajax({
        url: "{{ route('saveTouristDetails') }}", // Your route to save tourist details
        type: 'POST',
        data: formData,
        contentType: false, // Do not set contentType manually, jQuery will handle it
        processData: false, // Don't process data (important for file uploads)
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Send CSRF token
        },
        success: function(response) {
            alert('Tourist details saved successfully!');
            $('#packageDetailsModal').modal('hide');
        },
        error: function(xhr, status, error) {
            alert('An error occurred while saving tourist details');
            console.log('Status: ' + status);
            console.log('Error: ' + error);
            console.log('Response Text: ' + xhr.responseText); // Log error details
        }
    });
});





</script>



<script>
    $('#addTouristBtn').click(function() {
    let touristCount = $('.tourist-section').length + 1; // Count existing tourists and increment
    let newTouristSection = `
        <div class="tourist-section suther mb-4">
            <h6 class="fw-bold suther">Tourist ${touristCount}</h6>
            <div class="row mb-3 suther">
                <div class="col-md-6 suther">
                    <label for="touristName" class="form-label suther">Name</label>
                    <input type="text" class="form-control suther touristName" name="tourist[${touristCount}][name]" placeholder="Enter Name">
                </div>
                <div class="col-md-6 suther">
                    <label for="touristAge" class="form-label suther">Age</label>
                    <input type="number" class="form-control suther touristAge" name="tourist[${touristCount}][age]" placeholder="Enter Age">
                </div>
            </div>
            <div class="row mb-3 suther">
                <div class="col-md-6 suther">
                    <label for="touristPhone" class="form-label suther">Phone No.</label>
                    <input type="text" class="form-control suther touristPhone" name="tourist[${touristCount}][phone]" placeholder="Enter Phone No.">
                </div>
                <div class="col-md-6 suther">
                    <label for="aadharUploadFront" class="form-label suther">Aadhaar Card (Front)</label>
                    <input type="file" class="form-control suther touristAadharFront" name="tourist[${touristCount}][aadhar_front]">
                </div>
            </div>
            <div class="row mb-3 suther">
                <div class="col-md-6 suther">
                    <label for="aadharUploadBack" class="form-label suther">Aadhaar Card (Back)</label>
                    <input type="file" class="form-control suther touristAadharBack" name="tourist[${touristCount}][aadhar_back]">
                </div>
            </div>
            <button type="button" class="btn btn-danger suther remove-tourist-btn">Remove Tourist</button>
        </div>
    `;
    $('#touristContainer').append(newTouristSection); // Append the new tourist section
});



// Remove tourist section
$(document).on('click', '.remove-tourist-btn', function() {
    $(this).closest('.tourist-section').remove(); // Remove the closest tourist section div
});



</script>



<script>
    // document.addEventListener('DOMContentLoaded', () => {
    // let touristCount = 1; // Initial tourist count

    // // Add Tourist Button
    // document.getElementById('addTouristBtn').addEventListener('click', () => {
    //     touristCount++;
    //     const touristContainer = document.getElementById('touristContainer');

    //     // Create a new section for the tourist
    //     const newTouristSection = document.createElement('div');
    //     newTouristSection.className = 'tourist-section suther mb-4';
    //     newTouristSection.innerHTML = `
    //         <h6 class="fw-bold suther">Tourist ${touristCount}</h6>
    //         <div class="row mb-3 suther">
    //             <div class="col-md-6 suther">
    //                 <label for="touristName" class="form-label suther">Name</label>
    //                 <input type="text" class="form-control suther touristName" placeholder="Enter Name">
    //             </div>
    //             <div class="col-md-6 suther">
    //                 <label for="touristAge" class="form-label suther">Age</label>
    //                 <input type="number" class="form-control suther touristAge" placeholder="Enter Age">
    //             </div>
    //         </div>
    //         <div class="row mb-3 suther">
    //             <div class="col-md-6 suther">
    //                 <label for="touristPhone" class="form-label suther">Phone No.</label>
    //                 <input type="text" class="form-control suther touristPhone" placeholder="Enter Phone No.">
    //             </div>
    //             <div class="col-md-6 suther">
    //                 <label for="aadharUploadFront" class="form-label suther">Aadhaar Card (Front)</label>
    //                 <input type="file" class="form-control suther touristAadharFront">
    //             </div>
    //         </div>
    //         <div class="row mb-3 suther">
    //             <div class="col-md-6 suther">
    //                 <label for="aadharUploadBack" class="form-label suther">Aadhaar Card (Back)</label>
    //                 <input type="file" class="form-control suther touristAadharBack">
    //             </div>
    //         </div>
    //         <button type="button" class="btn btn-danger suther remove-tourist-btn">Remove Tourist</button>
    //     `;

    //     // Append the new section
    //     touristContainer.appendChild(newTouristSection);

    //     // Add event listener for the remove button
    //     newTouristSection.querySelector('.remove-tourist-btn').addEventListener('click', () => {
    //         newTouristSection.remove();
    //     });
    // });

    // Initial Remove Tourist Button
    // document.querySelector('.remove-tourist-btn').addEventListener('click', function () {
    //     this.parentElement.remove();
    // });

    
// });


const touristData = {
        1: [
            { name: 'Alice Smith', age: 30, phone: '+1 123 456 7890' },
            { name: 'Bob Johnson', age: 35, phone: '+1 987 654 3210' }
        ],
        2: [
            { name: 'Charlie Brown', age: 28, phone: '+1 123 987 6543' }
        ]
    };

    // Function to display the tourist list in the modal
    function showTouristList(bookingId) {
        const touristList = touristData[bookingId] || [];
        const container = document.getElementById('touristListContainer');
        container.innerHTML = '';
        
        if (touristList.length > 0) {
            touristList.forEach((tourist, index) => {
                container.innerHTML += `
                    <div class="mb-3 suther">
                        <p><strong>Tourist ${index + 1}:</strong></p>
                        <p>Name: ${tourist.name}</p>
                        <p>Age: ${tourist.age}</p>
                        <p>Phone: ${tourist.phone}</p>
                    </div>
                    <hr>
                `;
            });
        } else {
            container.innerHTML = '<p>No tourist details available for this booking.</p>';
        }
    }
</script>
@endsection
