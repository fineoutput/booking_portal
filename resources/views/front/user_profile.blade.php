
@extends('front.common.app')
@section('title', 'Agent Profile')
@section('content')

<style>
    /* General styling for the table */
    .tourist-table {
        display: flex;
        flex-direction: column;
        border: 1px solid #ddd;
        margin-top: 15px;
    }
    .form-check-input {
        width: 20px;
        height: 20px;
        border: 2px solid #00000052 !important;
        background-color: white;
        cursor: pointer;
    }
    .tourist-table-header, .tourist-table-row {
        display: flex;
        justify-content: space-between;
        padding: 10px;
    }
    .tourist-table-cell {
        flex: 1;
        padding: 5px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }
    .tourist-table-header {
        background-color: #f7f7f7;
        font-weight: bold;
    }
    .tourist-table-row:nth-child(even) {
        background-color: #f9f9f9;
    }
    .tourist-table-row:last-child .tourist-table-cell {
        border-bottom: none;
    }
</style>

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
            <div class="row suther">
                <div class="col-md-6 suther">
                    <label class="fw-bold suther">Name:</label>
                    <p class="suther">{{ $user->name ?? '' }}</p>
                </div>
                <div class="col-md-6 suther">
                    <label class="fw-bold suther">Email:</label>
                    <p class="suther">{{ $user->email ?? '' }}</p>
                </div>
                <div class="col-md-6 suther">
                    <label class="fw-bold suther">Phone:</label>
                    <p class="suther">{{ $user->number ?? '' }}</p>
                </div>
                <div class="col-md-6 suther">
                    <label class="fw-bold suther">Business Name:</label>
                    <p class="suther">{{ $user->business_name ?? '' }}</p>
                </div>
                <div class="col-md-6 suther">
                    <label class="fw-bold suther">GST Number:</label>
                    <p class="suther">{{ $user->GST_number ?? '' }}</p>
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
                            <img src="{{ asset($user->aadhar_image) }}" alt="Aadhar Image" style="max-width: 50px; max-height: 50px;">
                        @else
                            N/A
                        @endif
                    </p>
                </div>
                <div class="col-md-6 suther">
                    <label class="fw-bold suther">Aadhar Image Back:</label>
                    <p class="suther">
                        @if($user->aadhar_image_back)
                            <img src="{{ asset($user->aadhar_image_back) }}" alt="Aadhar Image" style="max-width: 50px; max-height: 50px;">
                        @else
                            N/A
                        @endif
                    </p>
                </div>
                <div class="col-md-6 suther">
                    <label class="fw-bold suther">Pancard Image:</label>
                    <p class="suther">
                        @if($user->pan_image)
                            <img src="{{ asset($user->pan_image) }}" alt="Pancard Image" style="max-width: 50px; max-height: 50px;">
                        @else
                            N/A
                        @endif
                    </p>
                </div>
                <div class="col-md-6 suther">
                    <label class="fw-bold suther">Logo:</label>
                    <p class="suther">
                        @if($user->logo)
                            <img src="{{ asset($user->logo) }}" alt="Logo" style="max-width: 50px; max-height: 50px;">
                        @else
                            N/A
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Bookings Tab -->
        <div class="tab-pane fade suther" id="bookings">
            <h5 class="fw-bold suther">Bookings</h5>
            <p class="suther">View your booking history and manage reservations.</p>

            <!-- Sub-tabs for Package, Hotel, and Safari -->
            <ul class="nav nav-tabs suther" id="bookingTabs">
                <li class="nav-item suther">
                    <a class="nav-link active suther" style="color: #000;" href="#packageBookings" data-bs-toggle="tab">Package Bookings</a>
                </li>
                <li class="nav-item suther">
                    <a class="nav-link suther" style="color: #000;" href="#hotelBookings" data-bs-toggle="tab">Hotel Bookings</a>
                </li>
                <li class="nav-item suther">
                    <a class="nav-link suther" style="color: #000;" href="#safariBookings" data-bs-toggle="tab">Safari Bookings</a>
                </li>
                <li class="nav-item suther">
                    <a class="nav-link suther" style="color: #000;" href="#taxibooking" data-bs-toggle="tab">Taxi Bookings</a>
                </li>
                
                <li class="nav-item suther">
                    <a class="nav-link suther" style="color: #000;" href="#guidebooking" data-bs-toggle="tab">Guide Bookings</a>
                </li>
            </ul>

            <!-- Sub-tab Content -->
            <div class="tab-content mt-3 suther">
                <!-- Package Bookings Tab -->
                <div class="tab-pane fade show active suther" id="packageBookings">
                    <h5 class="fw-bold suther">Package Bookings</h5>
                    <p class="suther">View your package booking history and manage reservations.</p>
                    <div class="table-responsive">
                        <table class="table table-bordered suther">
                            <thead class="suther">
                                <tr class="suther">
                                    <th class="suther">#</th>
                                    <th class="suther">Booking ID</th>
                                    <th class="suther">Package Name</th>
                                    <th class="suther">Booking Date</th>
                                    <th class="suther">Travel Date</th>
                                    <th class="suther">Status</th>
                                    <th class="suther">Action</th>
                                    <th class="suther">Tourist List</th>
                                    <th class="suther">Hotel Preference</th>
                                    <th class="suther">Request Upgrade</th>
                                    <th class="suther">Download PDF</th>
                                </tr>
                            </thead>
                            <tbody class="suther">
                                @foreach($booking as $key => $value)
                                    <tr class="suther">
                                        <td class="suther">{{ $key + 1 }}</td>
                                        <td class="suther">#{{ $value->id ?? '' }}</td>
                                        <td class="suther">{{ $value->package->package_name ?? '' }}</td>
                                        <td class="suther">{{ \Carbon\Carbon::parse($value->created_at)->format('d F Y') ?? '' }}</td>
                                        <td class="suther">
    {{ optional($value->packagetemp->start_date ? \Carbon\Carbon::parse($value->packagetemp->start_date) : null)->format('d F Y') }}
    -
    {{ optional($value->packagetemp->end_date ? \Carbon\Carbon::parse($value->packagetemp->end_date) : null)->format('d F Y') }}
</td>
                                        <td class="suther">
                                            @if($value->status == 0)
                                                Pending
                                            @elseif($value->status == 1)
                                                Complete
                                            @elseif($value->status == 2)
                                                Reject
                                            @elseif($value->status == 3)
                                                Under Inquiry
                                            @else
                                                Under Process
                                            @endif
                                        </td>
                                        <td class="suther">
                                            @if($value->status == 0 || $value->status == 2 || $value->status == 1)
                                                <!-- No action for Pending, Reject, or Complete -->
                                            @else
                                                {{-- <button style="width: 100%;" class="btn btn-primary suther" data-bs-toggle="modal" data-bs-target="#packageDetailsModal{{ $value->id }}" onclick="setBookingId({{ $value->id }})">Enter Details</button> --}}
                                                <a href="{{ route('tourists.create', [$value->id, 'package']) }}" class="btn btn-primary btn-sm">
                                                    Enter Details
                                                </a>
                                            @endif
                                        </td>
                                        <td class="suther">
                                            @if($value->status == 0 || $value->status == 2)
                                                <!-- No tourist list for Pending or Reject -->
                                            @else
                                                <button class="btn btn-secondary suther" data-bs-toggle="modal" data-bs-target="#touristListModal{{ $value->id }}" onclick="showTouristList({{ $value->id }})">View List</button>
                                            @endif
                                        </td>
                                        <th class="suther">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#hotelModal{{ $value->id }}">Hotel Preference</button>
                                        </th>
                                        <td class="suther">
                                            @if($value->status == 0 || $value->status == 2 || $value->status == 1)
                                                <!-- No upgrade request for Pending, Reject, or Complete -->
                                            @else
                                                <button class="btn btn-warning suther" data-bs-toggle="modal" data-bs-target="#upgradeRequestModal{{ $value->id }}">Request Upgrade</button>
                                            @endif
                                        </td>
                                        <td class="suther">
                                            @if($value->package->pdf ?? '')
                                                <button type="button" class="btn btn-primary mt-3" onclick="window.location.href='{{ route('pdf.download', ['user_id' => Auth::guard("agent")->id(), 'booking_id' => $value->id, 'pdf_name' => urlencode(basename($value->package->pdf))]) }}'">Download PDF</button>
                                            @else
                                                <p>No PDF available for download.</p>
                                            @endif
                                        </td>
                                    </tr>

                                    <!-- Upgrade Request Modal -->
                                    <div class="modal fade suther" id="upgradeRequestModal{{ $value->id }}" tabindex="-1" aria-labelledby="upgradeRequestModalLabel{{ $value->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg suther">
                                            <div class="modal-content suther">
                                                <div class="modal-header suther">
                                                    <h5 class="modal-title suther" id="upgradeRequestModalLabel{{ $value->id }}">Request Upgrade</h5>
                                                    <button type="button" class="btn-close suther" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body suther">
                                                    <form action="{{ route('upgrade_request') }}" class="suther" method="POST">
                                                        @csrf
                                                        <h6 class="fw-bold suther">Upgrade Request Details</h6>
                                                        <div class="mb-3 suther">
                                                            <label for="bookingId" class="form-label suther">Booking ID</label>
                                                            <input name="booking_id" value="{{ $value->id ?? '' }}" type="text" class="form-control suther" readonly id="bookingId" placeholder="Enter Booking ID">
                                                        </div>
                                                        <div class="mb-3 suther">
                                                            <label for="upgradeDetails" class="form-label suther">Upgrade Details</label>
                                                            <textarea name="upgrade_details" class="form-control suther" id="upgradeDetails" rows="3" placeholder="Enter Upgrade Details"></textarea>
                                                        </div>
                                                        <div class="mb-3 suther">
                                                            <label for="upgradeNotes" class="form-label suther">Notes</label>
                                                            <textarea name="notes" class="form-control suther" id="upgradeNotes" rows="3" placeholder="Enter Notes (Optional)"></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-success suther">Submit Request</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tourist List Modal -->
                                    <div class="modal fade suther" id="touristListModal{{ $value->id }}" tabindex="-1" aria-labelledby="touristListModalLabel{{ $value->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg suther">
                                            <div class="modal-content suther">
                                                <div class="modal-header suther">
                                                    <h5 class="modal-title suther" id="touristListModalLabel{{ $value->id }}">Tourist List for Booking #{{ $value->id }}</h5>
                                                    <button type="button" class="btn-close suther" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body suther">
                                                    <div class="suther">
                                                        @if($value->tourists->isEmpty())
                                                            <p>No tourists added for this booking.</p>
                                                        @else
                                                            <div class="tourist-table">
                                                                <div class="tourist-table-header">
                                                                    <div class="tourist-table-cell fw-bold">Name</div>
                                                                    <div class="tourist-table-cell fw-bold">Age</div>
                                                                    <div class="tourist-table-cell fw-bold">Phone</div>
                                                                </div>
                                                                @foreach($value->tourists->where('type', 'package') as $tourist)
                                                                    <div class="tourist-table-row">
                                                                        <div class="tourist-table-cell">{{ $tourist->name }}</div>
                                                                        <div class="tourist-table-cell">{{ $tourist->age }}</div>
                                                                        <div class="tourist-table-cell">{{ $tourist->phone }}</div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Package Details Modal -->
           <!-- Modal for each booking -->
<!-- Modal -->
<div class="modal fade" id="packageDetailsModal{{ $value->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Tourist Details - Booking #{{ $value->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- YE FORM PURA ANDAR HAI AUR SAHI BAND HAI -->
            <form method="POST" action="{{ route('saveTouristDetails') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="booking_id" value="{{ $value->id }}">

                <div class="modal-body">

                    <h6 class="fw-bold mb-3">Tourists Information</h6>

                    <!-- Container jahan JS tourists add karega -->
                    <div id="touristContainer{{ $value->id }}">
                        <!-- First tourist by default -->
                        <div class="tourist-section border p-4 rounded mb-3 bg-light">
                            <div class="d-flex justify-content-between mb-3">
                                <h6 class="fw-bold text-primary">Tourist 1</h6>
                                <button type="button" class="btn btn-danger btn-sm remove-tourist">Remove</button>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" name="tourist[1][name]" class="form-control" placeholder="Name" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" name="tourist[1][age]" class="form-control" placeholder="Age" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="tourist[1][phone]" class="form-control" placeholder="Phone" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="file" name="tourist[1][aadhar_front]" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <input type="file" name="tourist[1][aadhar_back]" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-success btn-sm mt-2" id="addTourist{{ $value->id }}">
                        Add Tourist
                    </button>

                    <div class="mt-4">
                        <label class="form-label">Additional Info (Optional)</label>
                        <textarea name="additional_info" class="form-control" rows="3"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save All Tourists</button>
                </div>
            </form>
            <!-- FORM YAHAN KHATAM -->

        </div>
    </div>
</div>

                                    <!-- Hotel Preference Modal -->
                                    <div class="modal fade suther" id="hotelModal{{ $value->id }}" tabindex="-1" aria-labelledby="hotelModalLabel{{ $value->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="hotelModalLabel{{ $value->id }}">Select Hotels</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('hotel_prefrence') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <ul class="list-group">
                                                            @foreach ($hotels as $valuess)
                                                                <li class="list-group-item d-flex align-items-center row">
                                                                    <div class="col-2">
                                                                        @php
                                                                            $images = json_decode($valuess->images);
                                                                        @endphp
                                                                        @if($images && is_array($images) && count($images) > 0)
                                                                            <img src="{{ asset(reset($images)) }}" class="rounded me-3" alt="Hotel Image">
                                                                        @else
                                                                            <p>No images available.</p>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-8" style="text-align: center; justify-content: center;">
                                                                        <div class="flex-grow-1">
                                                                            <h6 class="mb-0">{{ $valuess->name ?? '' }}</h6>
                                                                            @switch($valuess->hotel_category)
                                                                                @case('Standard')
                                                                                    <small>Standard ⭐ (1 star)</small>
                                                                                    @break
                                                                                @case('Deluxe')
                                                                                    <small>Deluxe ⭐⭐⭐ (3 star)</small>
                                                                                    @break
                                                                                @case('Premium_3')
                                                                                    <small>Premium ⭐⭐⭐ (3 star)</small>
                                                                                    @break
                                                                                @case('Super deluxe')
                                                                                    <small>Deluxe ⭐⭐⭐⭐ (4 star)</small>
                                                                                    @break
                                                                                @case('Premium')
                                                                                    <small>Premium ⭐⭐⭐⭐ (4 star)</small>
                                                                                    @break
                                                                                @case('Luxury')
                                                                                    <small>Deluxe ⭐⭐⭐⭐⭐ (5 star)</small>
                                                                                    @break
                                                                                @default
                                                                                    <small>{{ $valuess->hotel_category }}</small>
                                                                            @endswitch
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-2" style="text-align: right;">
                                                                        @php
                                                                            $alreadyAdded = isset($selected_hotels[$valuess->id]) ? true : false;
                                                                        @endphp
                                                                        <label>
                                                                            @if($alreadyAdded)
                                                                                <input type="checkbox" disabled class="form-check-input ms-auto" />
                                                                                <span class="text-muted">Already Added</span>
                                                                            @else
                                                                                <input type="checkbox" name="hotel_id[]" value="{{ $valuess->id }}" class="form-check-input ms-auto">
                                                                            @endif
                                                                            <input type="hidden" name="booking_id" value="{{ $value->id }}">
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

                <!-- Hotel Bookings Tab -->
                <div class="tab-pane fade suther" id="hotelBookings">
                    <h5 class="fw-bold suther">Hotel Bookings</h5>
                    <p class="suther">View your hotel booking history and manage reservations.</p>
                    <div class="table-responsive">
                        <table class="table table-bordered suther">
                            <thead class="suther">
                                <tr class="suther">
                                    <th class="suther">#</th>
                                    <th class="suther">Booking ID</th>
                                    <th class="suther">Hotel Name</th>
                                    <th class="suther">Booking Date</th>
                                    <th class="suther">Travel Date</th>
                                    <th class="suther">Status</th>
                                    <th class="suther">Action</th>
                                    <th class="suther">Tourist List</th>
                                    {{-- <th class="suther">Hotel Preference</th> --}}
                                    <th class="suther">Request Upgrade</th>
                                    <th class="suther">Download PDF</th>
                                </tr>
                            </thead>
                            <tbody class="suther">
                                @foreach ($hotels_data as $index => $value)
                                <tr class="suther">
                                    <td class="suther">{{$index+1}}</td>
                                    <td class="suther">#{{$value->id}}</td>
                                    <td class="suther">{{$value->hotel->name ?? ''}}</td>
                                    <td class="suther">{{ \Carbon\Carbon::parse($value->created_at)->format('d F Y') }}</td>
                                    <td class="suther">{{ \Carbon\Carbon::parse($value->hotel_se->check_in_date)->format('d F Y') }}-{{ \Carbon\Carbon::parse($value->hotel_se->check_out_date)->format('d F Y') }}</td>
                                      <td class="suther">
                                            @if($value->status == 0)
                                                Pending
                                            @elseif($value->status == 1)
                                                Complete
                                            @elseif($value->status == 2)
                                                Reject
                                            @elseif($value->status == 3)
                                                Under Inquiry
                                            @else
                                                Under Process
                                            @endif
                                        </td>
                                        <td class="suther">
                                            @if($value->status == 0 || $value->status == 2 || $value->status == 1)
                                                <!-- No action for Pending, Reject, or Complete -->
                                            @else
                                                {{-- <button style="width: 100%;" class="btn btn-primary suther" data-bs-toggle="modal" data-bs-target="#hotelDetailsModal2001{{ $value->id }}" onclick="setBookingId({{ $value->id }})">Enter Details</button> --}}
                                                 <a href="{{ route('tourists.create', [$value->id, 'hotel']) }}" class="btn btn-primary btn-sm">
                                                    Enter Details
                                                </a>
                                            @endif
                                        </td>
                                        <td class="suther">
                                            @if($value->status == 0 || $value->status == 2)
                                                <!-- No tourist list for Pending or Reject -->
                                            @else
                                                <button class="btn btn-secondary suther" data-bs-toggle="modal" data-bs-target="#hotelTouristListModal2001{{ $value->id }}" onclick="showTouristList({{ $value->id }})">View List</button>
                                            @endif
                                        </td>
                                        {{-- <th class="suther">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#hotelPreferenceModal2001{{ $value->id }}">Hotel Preference</button>
                                        </th> --}}
                                        <td class="suther">
                                            @if($value->status == 0 || $value->status == 2 || $value->status == 1)
                                                <!-- No upgrade request for Pending, Reject, or Complete -->
                                            @else
                                                <button class="btn btn-warning suther" data-bs-toggle="modal" data-bs-target="#hotelUpgradeRequestModal2001{{ $value->id }}">Request Upgrade</button>
                                            @endif
                                        </td>
                                        <td class="suther">
                                            @if($value->package->pdf ?? '')
                                                <button type="button" class="btn btn-primary mt-3" onclick="window.location.href='{{ route('pdf.download', ['user_id' => Auth::id(), 'booking_id' => $value->id, 'pdf_name' => urlencode(basename($value->package->pdf))]) }}'">Download PDF</button>
                                            @else
                                                <p>No PDF available for download.</p>
                                            @endif
                                        </td>
                                </tr>
                               

                                <!-- Modals for Hotel Booking #2001 -->
                                <!-- Hotel Upgrade Request Modal -->
                                <div class="modal fade suther" id="hotelUpgradeRequestModal2001{{ $value->id ?? ''}}" tabindex="-1" aria-labelledby="hotelUpgradeRequestModalLabel2001" aria-hidden="true">
                                    <div class="modal-dialog modal-lg suther">
                                        <div class="modal-content suther">
                                            <div class="modal-header suther">
                                                <h5 class="modal-title suther" id="hotelUpgradeRequestModalLabel2001">Request Hotel Upgrade</h5>
                                                <button type="button" class="btn-close suther" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body suther">
                                                <form action="{{route('upgrade_requesthotel')}}" class="suther" method="POST">
                                                    @csrf
                                                    <h6 class="fw-bold suther">Upgrade Request Details</h6>
                                                    <div class="mb-3 suther">
                                                        <label for="bookingId" class="form-label suther">Booking ID</label>
                                                        <input name="booking_id" value="{{$value->id ?? ''}}" type="text" class="form-control suther" readonly id="bookingId" placeholder="Enter Booking ID">
                                                    </div>
                                                    <div class="mb-3 suther">
                                                        <label for="upgradeDetails" class="form-label suther">Upgrade Details</label>
                                                        <textarea name="upgrade_details" class="form-control suther" id="upgradeDetails" rows="3" placeholder="Enter Upgrade Details"></textarea>
                                                    </div>
                                                    <div class="mb-3 suther">
                                                        <label for="upgradeNotes" class="form-label suther">Notes</label>
                                                        <textarea name="notes" class="form-control suther" id="upgradeNotes" rows="3" placeholder="Enter Notes (Optional)"></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-success suther">Submit Request</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Hotel Tourist List Modal -->
                                <div class="modal fade suther" id="hotelTouristListModal2001{{$value->id ?? ''}}" tabindex="-1" aria-labelledby="hotelTouristListModalLabel2001" aria-hidden="true">
                                    <div class="modal-dialog modal-lg suther">
                                        <div class="modal-content suther">
                                            <div class="modal-header suther">
                                                <h5 class="modal-title suther" id="hotelTouristListModalLabel2001">Tourist List for Hotel Booking {{$value->id ?? ''}}</h5>
                                                <button type="button" class="btn-close suther" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body suther">
                                                <div class="suther" id="touristListContainerhotel">
                                                    <div class="tourist-table">
                                                        <div class="tourist-table-header">
                                                            <div class="tourist-table-cell fw-bold">Name</div>
                                                            <div class="tourist-table-cell fw-bold">Age</div>
                                                            <div class="tourist-table-cell fw-bold">Phone</div>
                                                        </div>
                                                       @foreach($value->tourists->where('type', 'hotel') as $tourist)
                                                            <div class="tourist-table-row">
                                                                <div class="tourist-table-cell">{{ $tourist->name }}</div>
                                                                <div class="tourist-table-cell">{{ $tourist->age }}</div>
                                                                <div class="tourist-table-cell">{{ $tourist->phone }}</div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Hotel Details Modal -->
                                <div class="modal fade suther" id="hotelDetailsModal2001{{$value->id}}" tabindex="-1" aria-labelledby="hotelDetailsModalLabel2001" aria-hidden="true">
                                    <div class="modal-dialog modal-lg suther">
                                        <div class="modal-content suther">
                                            <div class="modal-header suther">
                                                <h5 class="modal-title suther" id="hotelDetailsModalLabel2001">Enter Hotel Booking Details</h5>
                                                <button type="button" class="btn-close suther" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form enctype="multipart/form-data" method="POST" action="{{route('saveTouristDetailshotel')}}" class="suther" id="hotelTouristForm{{ $value->id ?? ''}}">
                                                @csrf
                                                <div class="modal-body suther">
                                                    <input type="hidden" id="bookingIdss" name="booking_id" value="{{ $value->id ?? ''}}">
                                                    <h6 class="fw-bold suther">Tourists Information</h6>
                                                    <div id="hotelTouristContainer{{ $value->id }}" class="mb-3 suther">
                                                        <div class="tourist-section suther mb-4" data-tourist-id="1">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <h6 class="fw-bold suther">Tourist 1</h6>
                                                                <button type="button" class="btn btn-danger btn-sm remove-tourist suther" style="display: none;">Remove</button>
                                                            </div>
                                                            <div class="row mb-3 suther">
                                                                <div class="col-md-6 suther">
                                                                    <label for="touristName1" class="form-label suther">Name</label>
                                                                    <input type="text" class="form-control suther touristName" name="tourist[1][name]" id="touristName1" placeholder="Enter Name">
                                                                </div>
                                                                <div class="col-md-6 suther">
                                                                    <label for="touristAge1" class="form-label suther">Age</label>
                                                                    <input type="number" class="form-control suther touristAge" name="tourist[1][age]" id="touristAge1" placeholder="Enter Age">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3 suther">
                                                                <div class="col-md-6 suther">
                                                                    <label for="touristPhone1" class="form-label suther">Phone No.</label>
                                                                    <input type="text" class="form-control suther touristPhone" name="tourist[1][phone]" id="touristPhone1" placeholder="Enter Phone No.">
                                                                </div>
                                                                <div class="col-md-6 suther">
                                                                    <label for="aadharUploadFront1" class="form-label suther">Aadhaar Card (Front)</label>
                                                                    <input id="aadharUploadFront1" type="file" class="form-control suther touristAadharFront" name="tourist[1][aadhar_front]">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3 suther">
                                                                <div class="col-md-6 suther">
                                                                    <label for="aadharUploadBack1" class="form-label suther">Aadhaar Card (Back)</label>
                                                                    <input id="aadharUploadBack1" type="file" class="form-control suther touristAadharBack" name="tourist[1][aadhar_back]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-success suther mb-3" id="addHotelTourist{{ $value->id }}">Add Tourist</button>
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
                                <!-- Hotel Preference Modal -->
                                <div class="modal fade" id="hotelPreferenceModal2001{{$value->id ?? ''}}" tabindex="-1" aria-labelledby="hotelPreferenceModalLabel2001" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="hotelPreferenceModalLabel2001">Select Hotels</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="/hotel_prefrence" method="POST">
                                                <div class="modal-body">
                                                    <ul class="list-group">
                                                        <li class="list-group-item d-flex align-items-center row">
                                                            <div class="col-2">
                                                                <img src="hotel1.jpg" class="rounded me-3" alt="Hotel Image">
                                                            </div>
                                                            <div class="col-8" style="text-align: center; justify-content: center;">
                                                                <div class="flex-grow-1">
                                                                    <h6 class="mb-0">Grand Hotel</h6>
                                                                    <small>Deluxe ⭐⭐⭐ (3 star)</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-2" style="text-align: right;">
                                                                <label>
                                                                    <input type="checkbox" name="hotel_id[]" value="1" class="form-check-input ms-auto">
                                                                    <input type="hidden" name="booking_id" value="2001">
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center row">
                                                            <div class="col-2">
                                                                <img src="hotel2.jpg" class="rounded me-3" alt="Hotel Image">
                                                            </div>
                                                            <div class="col-8" style="text-align: center; justify-content: center;">
                                                                <div class="flex-grow-1">
                                                                    <h6 class="mb-0">Luxury Resort</h6>
                                                                    <small>Deluxe ⭐⭐⭐⭐⭐ (5 star)</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-2" style="text-align: right;">
                                                                <label>
                                                                    <input type="checkbox" disabled class="form-check-input ms-auto" />
                                                                    <span class="text-muted">Already Added</span>
                                                                    <input type="hidden" name="booking_id" value="2001">
                                                                </label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

                <!-- Safari Bookings Tab -->
                <div class="tab-pane fade suther" id="safariBookings">
                    <h5 class="fw-bold suther">Safari Bookings</h5>
                    <p class="suther">View your safari booking history and manage reservations.</p>
                    <div class="table-responsive">
                        <table class="table table-bordered suther">
                            <thead class="suther">
                                <tr class="suther">
                                    <th class="suther">#</th>
                                    <th class="suther">Booking ID</th>
                                    <th class="suther">Safari Name</th>
                                    <th class="suther">Date</th>
                                    <th class="suther">Status</th>
                                    <th class="suther">Action</th>
                                    <th class="suther">Tourist List</th>
                                    {{-- <th class="suther">Hotel Preference</th>
                                    <th class="suther">Request Upgrade</th> --}}
                                    <th class="suther">Download PDF</th>
                                </tr>
                            </thead>
                            <tbody class="suther">
                                    @foreach ($WildlifeSafari_data as $index => $value)
                                <tr class="suther">
                                    <td class="suther">{{$index+1}}</td>
                                    <td class="suther">#{{$value->id}}</td>
                                    <td class="suther">{{$value->safari->national_park ?? ''}}</td>
                                    <td class="suther">{{ \Carbon\Carbon::parse($value->created_at)->format('d F Y') }}</td>
                                      <td class="suther">
                                            @if($value->status == 0)
                                                Pending
                                            @elseif($value->status == 1)
                                                Complete
                                            @elseif($value->status == 2)
                                                Reject
                                            @elseif($value->status == 3)
                                                Under Inquiry
                                            @else
                                                Under Process
                                            @endif
                                        </td>
                                        <td class="suther">
                                            @if($value->status == 0 || $value->status == 2 || $value->status == 1)
                                                <!-- No action for Pending, Reject, or Complete -->
                                            @else
                                                {{-- <button style="width: 100%;" class="btn btn-primary suther" data-bs-toggle="modal" data-bs-target="#safariDetailsModal3001{{ $value->id }}" onclick="setBookingId({{ $value->id }})">Enter Details</button> --}}
                                                 <a href="{{ route('tourists.create', [$value->id, 'safari']) }}" class="btn btn-primary btn-sm">
                                                    Enter Details
                                                </a>
                                            @endif
                                        </td>
                                        <td class="suther">
                                            @if($value->status == 0 || $value->status == 2)
                                                <!-- No tourist list for Pending or Reject -->
                                            @else
                                                <button class="btn btn-secondary suther" data-bs-toggle="modal" data-bs-target="#safariTouristListModal3001{{ $value->id }}" onclick="showTouristList({{ $value->id }})">View List</button>
                                            @endif
                                        </td>
                                        {{-- <th class="suther">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#hotelPreferenceModal2001{{ $value->id }}">Hotel Preference</button>
                                        </th> --}}
                                        {{-- <td class="suther">
                                            @if($value->status == 0 || $value->status == 2 || $value->status == 1)
                                                <!-- No upgrade request for Pending, Reject, or Complete -->
                                            @else
                                                <button class="btn btn-warning suther" data-bs-toggle="modal" data-bs-target="#hotelUpgradeRequestModal2001{{ $value->id }}">Request Upgrade</button>
                                            @endif
                                        </td> --}}
                                        <td class="suther">
                                            @if($value->package->pdf ?? '')
                                                <button type="button" class="btn btn-primary mt-3" onclick="window.location.href='{{ route('pdf.download', ['user_id' => Auth::id(), 'booking_id' => $value->id, 'pdf_name' => urlencode(basename($value->package->pdf))]) }}'">Download PDF</button>
                                            @else
                                                <p>No PDF available for download.</p>
                                            @endif
                                        </td>
                                
                                <!-- Modals for Safari Booking #3001 -->
                                <!-- Safari Upgrade Request Modal -->
                                <div class="modal fade suther" id="safariUpgradeRequestModal3001" tabindex="-1" aria-labelledby="safariUpgradeRequestModalLabel3001" aria-hidden="true">
                                    <div class="modal-dialog modal-lg suther">
                                        <div class="modal-content suther">
                                            <div class="modal-header suther">
                                                <h5 class="modal-title suther" id="safariUpgradeRequestModalLabel3001">Request Safari Upgrade</h5>
                                                <button type="button" class="btn-close suther" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body suther">
                                                <form action="/upgrade_request" class="suther" method="POST">
                                                    <h6 class="fw-bold suther">Upgrade Request Details</h6>
                                                    <div class="mb-3 suther">
                                                        <label for="bookingId" class="form-label suther">Booking ID</label>
                                                        <input name="booking_id" value="3001" type="text" class="form-control suther" readonly id="bookingId" placeholder="Enter Booking ID">
                                                    </div>
                                                    <div class="mb-3 suther">
                                                        <label for="upgradeDetails" class="form-label suther">Upgrade Details</label>
                                                        <textarea name="upgrade_details" class="form-control suther" id="upgradeDetails" rows="3" placeholder="Enter Upgrade Details"></textarea>
                                                    </div>
                                                    <div class="mb-3 suther">
                                                        <label for="upgradeNotes" class="form-label suther">Notes</label>
                                                        <textarea name="notes" class="form-control suther" id="upgradeNotes" rows="3" placeholder="Enter Notes (Optional)"></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-success suther">Submit Request</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Safari Tourist List Modal -->
                                <div class="modal fade suther" id="safariTouristListModal3001{{$value->id ?? ''}}" tabindex="-1" aria-labelledby="safariTouristListModalLabel3001" aria-hidden="true">
                                    <div class="modal-dialog modal-lg suther">
                                        <div class="modal-content suther">
                                            <div class="modal-header suther">
                                                <h5 class="modal-title suther" id="safariTouristListModalLabel3001">Tourist List for Safari Booking #{{$value->id ?? ''}}</h5>
                                                <button type="button" class="btn-close suther" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body suther">
                                                <div class="suther" id="touristListContainersafari">
                                                    <div class="tourist-table">
                                                        <div class="tourist-table-header">
                                                            <div class="tourist-table-cell fw-bold">Name</div>
                                                            <div class="tourist-table-cell fw-bold">Age</div>
                                                            <div class="tourist-table-cell fw-bold">Phone</div>
                                                        </div>
                                                       @foreach($value->tourists->where('type','safari') as $tourist)
                                                                    <div class="tourist-table-row">
                                                                        <div class="tourist-table-cell">{{ $tourist->name }}</div>
                                                                        <div class="tourist-table-cell">{{ $tourist->age }}</div>
                                                                        <div class="tourist-table-cell">{{ $tourist->phone }}</div>
                                                                    </div>
                                                                @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Safari Details Modal -->
                                <div class="modal fade suther" id="safariDetailsModal3001{{$value->id ?? ''}}" tabindex="-1" aria-labelledby="safariDetailsModalLabel3001" aria-hidden="true">
                                    <div class="modal-dialog modal-lg suther">
                                        <div class="modal-content suther">
                                            <div class="modal-header suther">
                                                <h5 class="modal-title suther" id="safariDetailsModalLabel3001">Enter Safari Booking Details</h5>
                                                <button type="button" class="btn-close suther" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form enctype="multipart/form-data" method="POST" action="{{route('saveTouristDetailssafari')}}" class="suther" id="safariTouristForm{{ $value->id ?? '' }}">
                                                @csrf
                                                <div class="modal-body suther">
                                                    <input type="hidden" id="bookingIdss" name="booking_id" value="{{$value->id ?? ''}}">
                                                    <h6 class="fw-bold suther">Tourists Information</h6>
                                                    <div id="safariTouristContainer{{ $value->id ?? '' }}" class="mb-3 suther">
                                                        <div class="tourist-section suther mb-4" data-tourist-id="1">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <h6 class="fw-bold suther">Tourist 1</h6>
                                                                <button type="button" class="btn btn-danger btn-sm remove-tourist suther" style="display: none;">Remove</button>
                                                            </div>
                                                            <div class="row mb-3 suther">
                                                                <div class="col-md-6 suther">
                                                                    <label for="touristName1" class="form-label suther">Name</label>
                                                                    <input type="text" class="form-control suther touristName" name="tourist[1][name]" id="touristName1" placeholder="Enter Name">
                                                                </div>
                                                                <div class="col-md-6 suther">
                                                                    <label for="touristAge1" class="form-label suther">Age</label>
                                                                    <input type="number" class="form-control suther touristAge" name="tourist[1][age]" id="touristAge1" placeholder="Enter Age">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3 suther">
                                                                <div class="col-md-6 suther">
                                                                    <label for="touristPhone1" class="form-label suther">Phone No.</label>
                                                                    <input type="text" class="form-control suther touristPhone" name="tourist[1][phone]" id="touristPhone1" placeholder="Enter Phone No.">
                                                                </div>
                                                                <div class="col-md-6 suther">
                                                                    <label for="aadharUploadFront1" class="form-label suther">Aadhaar Card (Front)</label>
                                                                    <input id="aadharUploadFront1" type="file" class="form-control suther touristAadharFront" name="tourist[1][aadhar_front]">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3 suther">
                                                                <div class="col-md-6 suther">
                                                                    <label for="aadharUploadBack1" class="form-label suther">Aadhaar Card (Back)</label>
                                                                    <input id="aadharUploadBack1" type="file" class="form-control suther touristAadharBack" name="tourist[1][aadhar_back]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-success suther mb-3" id="addSafariTourist{{ $value->id ?? '' }}">Add Tourist</button>
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
                                <!-- Safari Hotel Preference Modal -->
                                <div class="modal fade" id="safariHotelPreferenceModal3001" tabindex="-1" aria-labelledby="safariHotelPreferenceModalLabel3001" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="safariHotelPreferenceModalLabel3001">Select Hotels</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="/hotel_prefrence" method="POST">
                                                <div class="modal-body">
                                                    <ul class="list-group">
                                                        <li class="list-group-item d-flex align-items-center row">
                                                            <div class="col-2">
                                                                <img src="hotel1.jpg" class="rounded me-3" alt="Hotel Image">
                                                            </div>
                                                            <div class="col-8" style="text-align: center; justify-content: center;">
                                                                <div class="flex-grow-1">
                                                                    <h6 class="mb-0">Grand Hotel</h6>
                                                                    <small>Deluxe ⭐⭐⭐ (3 star)</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-2" style="text-align: right;">
                                                                <label>
                                                                    <input type="checkbox" name="hotel_id[]" value="1" class="form-check-input ms-auto">
                                                                    <input type="hidden" name="booking_id" value="3001">
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center row">
                                                            <div class="col-2">
                                                                <img src="hotel2.jpg" class="rounded me-3" alt="Hotel Image">
                                                            </div>
                                                            <div class="col-8" style="text-align: center; justify-content: center;">
                                                                <div class="flex-grow-1">
                                                                    <h6 class="mb-0">Luxury Resort</h6>
                                                                    <small>Deluxe ⭐⭐⭐⭐⭐ (5 star)</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-2" style="text-align: right;">
                                                                <label>
                                                                    <input type="checkbox" disabled class="form-check-input ms-auto" />
                                                                    <span class="text-muted">Already Added</span>
                                                                    <input type="hidden" name="booking_id" value="3001">
                                                                </label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

                <!-- Taxi Bookings Tab -->
                <div class="tab-pane fade suther" id="taxibooking">
                    <h5 class="fw-bold suther">Taxi Bookings</h5>
                    <p class="suther">View your safari booking history and manage reservations.</p>
                    <div class="table-responsive">
                        <table class="table table-bordered suther">
                            <thead class="suther">
                                <tr class="suther">
                                    <th class="suther">#</th>
                                    <th class="suther">Booking ID</th>
                                    <th class="suther">city_name</th>
                                    <th class="suther">Tour Type</th>
                                    <th class="suther">Date</th>
                                    <th class="suther">Status</th>
                                    <th class="suther">Action</th>
                                    <th class="suther">Tourist List</th>
                                    {{-- <th class="suther">Hotel Preference</th>
                                    <th class="suther">Request Upgrade</th> --}}1
                                    <th class="suther">Download PDF</th>
                                </tr>
                            </thead>
                            <tbody class="suther">
                                    @foreach ($Taxi_data as $index => $value)
                                <tr class="suther">
                                    <td class="suther">{{$index+1}}</td>
                                    <td class="suther">#{{$value->id}}</td>
                                    <td class="suther">{{$value->taxi_se->admincity->city_name ?? ''}}</td>
                                    <td class="suther">{{$value->tour_type ?? ''}}</td>
                                    <td class="suther">{{ \Carbon\Carbon::parse($value->created_at)->format('d F Y') }}</td>
                                      <td class="suther">
                                            @if($value->status == 0)
                                                Pending
                                            @elseif($value->status == 1)
                                                Complete
                                            @elseif($value->status == 2)
                                                Reject
                                            @elseif($value->status == 3)
                                                Under Inquiry
                                            @else
                                                Under Process
                                            @endif
                                        </td>
                                        <td class="suther">
                                            @if($value->status == 0 || $value->status == 2 || $value->status == 1)
                                                <!-- No action for Pending, Reject, or Complete -->
                                            @else
                                                {{-- <button style="width: 100%;" class="btn btn-primary suther" data-bs-toggle="modal" data-bs-target="#taxiDetailsModal3001{{ $value->id }}" onclick="setBookingId({{ $value->id }})">Enter Details</button> --}}
                                                 <a href="{{ route('tourists.create', [$value->id, 'Taxi']) }}" class="btn btn-primary btn-sm">
                                                    Enter Details
                                                </a>
                                            @endif
                                        </td>
                                        <td class="suther">
                                            @if($value->status == 0 || $value->status == 2)
                                                <!-- No tourist list for Pending or Reject -->
                                            @else
                                                <button class="btn btn-secondary suther" data-bs-toggle="modal" data-bs-target="#taxiTouristListModal3001{{ $value->id }}" onclick="showTouristList({{ $value->id }})">View List</button>
                                            @endif
                                        </td>
                                        {{-- <th class="suther">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#hotelPreferenceModal2001{{ $value->id }}">Hotel Preference</button>
                                        </th> --}}
                                        {{-- <td class="suther">
                                            @if($value->status == 0 || $value->status == 2 || $value->status == 1)
                                                <!-- No upgrade request for Pending, Reject, or Complete -->
                                            @else
                                                <button class="btn btn-warning suther" data-bs-toggle="modal" data-bs-target="#hotelUpgradeRequestModal2001{{ $value->id }}">Request Upgrade</button>
                                            @endif
                                        </td> --}}
                                        <td class="suther">
                                            @if($value->package->pdf ?? '')
                                                <button type="button" class="btn btn-primary mt-3" onclick="window.location.href='{{ route('pdf.download', ['user_id' => Auth::id(), 'booking_id' => $value->id, 'pdf_name' => urlencode(basename($value->package->pdf))]) }}'">Download PDF</button>
                                            @else
                                                <p>No PDF available for download.</p>
                                            @endif
                                        </td>
                                
                                <!-- Modals for Safari Booking #3001 -->
                                <!-- Safari Upgrade Request Modal -->
                                <div class="modal fade suther" id="taxiUpgradeRequestModal3001" tabindex="-1" aria-labelledby="taxiUpgradeRequestModalLabel3001" aria-hidden="true">
                                    <div class="modal-dialog modal-lg suther">
                                        <div class="modal-content suther">
                                            <div class="modal-header suther">
                                                <h5 class="modal-title suther" id="taxiUpgradeRequestModalLabel3001">Request Safari Upgrade</h5>
                                                <button type="button" class="btn-close suther" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body suther">
                                                <form action="/upgrade_request" class="suther" method="POST">
                                                    <h6 class="fw-bold suther">Upgrade Request Details</h6>
                                                    <div class="mb-3 suther">
                                                        <label for="bookingId" class="form-label suther">Booking ID</label>
                                                        <input name="booking_id" value="3001" type="text" class="form-control suther" readonly id="bookingId" placeholder="Enter Booking ID">
                                                    </div>
                                                    <div class="mb-3 suther">
                                                        <label for="upgradeDetails" class="form-label suther">Upgrade Details</label>
                                                        <textarea name="upgrade_details" class="form-control suther" id="upgradeDetails" rows="3" placeholder="Enter Upgrade Details"></textarea>
                                                    </div>
                                                    <div class="mb-3 suther">
                                                        <label for="upgradeNotes" class="form-label suther">Notes</label>
                                                        <textarea name="notes" class="form-control suther" id="upgradeNotes" rows="3" placeholder="Enter Notes (Optional)"></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-success suther">Submit Request</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Safari Tourist List Modal -->
                                <div class="modal fade suther" id="taxiTouristListModal3001{{$value->id ?? ''}}" tabindex="-1" aria-labelledby="taxiTouristListModalLabel3001" aria-hidden="true">
                                    <div class="modal-dialog modal-lg suther">
                                        <div class="modal-content suther">
                                            <div class="modal-header suther">
                                                <h5 class="modal-title suther" id="taxiTouristListModalLabel3001">Tourist List for Taxi Booking #{{$value->id ?? ''}}</h5>
                                                <button type="button" class="btn-close suther" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body suther">
                                                <div class="suther" id="touristListContainersafari">
                                                    <div class="tourist-table">
                                                        <div class="tourist-table-header">
                                                            <div class="tourist-table-cell fw-bold">Name</div>
                                                            <div class="tourist-table-cell fw-bold">Age</div>
                                                            <div class="tourist-table-cell fw-bold">Phone</div>
                                                        </div>
                                                       @foreach($value->tourists->where('type','Taxi') as $tourist)
                                                                    <div class="tourist-table-row">
                                                                        <div class="tourist-table-cell">{{ $tourist->name }}</div>
                                                                        <div class="tourist-table-cell">{{ $tourist->age }}</div>
                                                                        <div class="tourist-table-cell">{{ $tourist->phone }}</div>
                                                                    </div>
                                                                @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Safari Details Modal -->
                                <div class="modal fade suther" id="taxiDetailsModal3001{{$value->id ?? ''}}" tabindex="-1" aria-labelledby="safariDetailsModalLabel3001" aria-hidden="true">
                                    <div class="modal-dialog modal-lg suther">
                                        <div class="modal-content suther">
                                            <div class="modal-header suther">
                                                <h5 class="modal-title suther" id="safariDetailsModalLabel3001">Enter Taxi Booking Details</h5>
                                                <button type="button" class="btn-close suther" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form enctype="multipart/form-data" method="POST" action="{{route('saveTouristDetailsTaxi')}}" class="suther" id="taxiTouristForm{{ $value->id ?? '' }}">
                                                @csrf
                                                <div class="modal-body suther">
                                                    <input type="hidden" id="bookingIdss" name="booking_id" value="{{$value->id ?? ''}}">
                                                    <h6 class="fw-bold suther">Tourists Information</h6>
                                                    <div id="taxiTouristContainer{{ $value->id ?? '' }}" class="mb-3 suther">
                                                        <div class="tourist-section suther mb-4" data-tourist-id="1">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <h6 class="fw-bold suther">Tourist 1</h6>
                                                                <button type="button" class="btn btn-danger btn-sm remove-tourist suther" style="display: none;">Remove</button>
                                                            </div>
                                                            <div class="row mb-3 suther">
                                                                <div class="col-md-6 suther">
                                                                    <label for="touristName1" class="form-label suther">Name</label>
                                                                    <input type="text" class="form-control suther touristName" name="tourist[1][name]" id="touristName1" placeholder="Enter Name">
                                                                </div>
                                                                <div class="col-md-6 suther">
                                                                    <label for="touristAge1" class="form-label suther">Age</label>
                                                                    <input type="number" class="form-control suther touristAge" name="tourist[1][age]" id="touristAge1" placeholder="Enter Age">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3 suther">
                                                                <div class="col-md-6 suther">
                                                                    <label for="touristPhone1" class="form-label suther">Phone No.</label>
                                                                    <input type="text" class="form-control suther touristPhone" name="tourist[1][phone]" id="touristPhone1" placeholder="Enter Phone No.">
                                                                </div>
                                                                <div class="col-md-6 suther">
                                                                    <label for="aadharUploadFront1" class="form-label suther">Aadhaar Card (Front)</label>
                                                                    <input id="aadharUploadFront1" type="file" class="form-control suther touristAadharFront" name="tourist[1][aadhar_front]">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3 suther">
                                                                <div class="col-md-6 suther">
                                                                    <label for="aadharUploadBack1" class="form-label suther">Aadhaar Card (Back)</label>
                                                                    <input id="aadharUploadBack1" type="file" class="form-control suther touristAadharBack" name="tourist[1][aadhar_back]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-success suther mb-3" id="addTaxiTourist{{ $value->id ?? '' }}">Add Tourist</button>
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
                                <!-- Safari Hotel Preference Modal -->
                                <div class="modal fade" id="safariHotelPreferenceModal3001" tabindex="-1" aria-labelledby="safariHotelPreferenceModalLabel3001" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="safariHotelPreferenceModalLabel3001">Select Hotels</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="/hotel_prefrence" method="POST">
                                                <div class="modal-body">
                                                    <ul class="list-group">
                                                        <li class="list-group-item d-flex align-items-center row">
                                                            <div class="col-2">
                                                                <img src="hotel1.jpg" class="rounded me-3" alt="Hotel Image">
                                                            </div>
                                                            <div class="col-8" style="text-align: center; justify-content: center;">
                                                                <div class="flex-grow-1">
                                                                    <h6 class="mb-0">Grand Hotel</h6>
                                                                    <small>Deluxe ⭐⭐⭐ (3 star)</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-2" style="text-align: right;">
                                                                <label>
                                                                    <input type="checkbox" name="hotel_id[]" value="1" class="form-check-input ms-auto">
                                                                    <input type="hidden" name="booking_id" value="3001">
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center row">
                                                            <div class="col-2">
                                                                <img src="hotel2.jpg" class="rounded me-3" alt="Hotel Image">
                                                            </div>
                                                            <div class="col-8" style="text-align: center; justify-content: center;">
                                                                <div class="flex-grow-1">
                                                                    <h6 class="mb-0">Luxury Resort</h6>
                                                                    <small>Deluxe ⭐⭐⭐⭐⭐ (5 star)</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-2" style="text-align: right;">
                                                                <label>
                                                                    <input type="checkbox" disabled class="form-check-input ms-auto" />
                                                                    <span class="text-muted">Already Added</span>
                                                                    <input type="hidden" name="booking_id" value="3001">
                                                                </label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                
                
                <!-- Guide Bookings Tab -->
                <div class="tab-pane fade suther" id="guidebooking">
                    <h5 class="fw-bold suther">Guide Bookings</h5>
                    <p class="suther">View your Guide booking history and manage reservations.</p>
                    <div class="table-responsive">
                        <table class="table table-bordered suther">
                            <thead class="suther">
                                <tr class="suther">
                                    <th class="suther">#</th>
                                    <th class="suther">Booking ID</th>
                                    <th class="suther">Salesman Name</th>
                                    <th class="suther">Salesman Phone</th>
                                    <th class="suther">State</th>
                                    <th class="suther">City</th>
                                    <th class="suther">Language</th>
                                    <th class="suther">Guide Type</th>
                                    <th class="suther">Date</th>
                                    <th class="suther">Status</th>
                                    <th class="suther">Action</th>
                                    <th class="suther">Tourist List</th>
                                    {{-- <th class="suther">Hotel Preference</th>
                                    <th class="suther">Request Upgrade</th> --}}1
                                    <th class="suther">Download PDF</th>
                                </tr>
                            </thead>
                            <tbody class="suther">
                                    @foreach ($Guide_data as $index => $value)
                                <tr class="suther">
                                    <td class="suther">{{$index+1}}</td>
                                    <td class="suther">#{{$value->id}}</td>
                                    <td class="suther">{{$value->salesman_name ?? ''}}</td>
                                    <td class="suther">{{$value->salesman_mobile ?? ''}}</td>
                                    <td class="suther">{{$value->guide->state->state_name ?? '' }}</td>
                                   
                                    <td class="suther">{{$value->guide->cities->city_name ?? '' }}</td>
                                    <td class="suther">{{$value->guide_se->languages->language_name ?? ''}}</td>
                                    <td>
                                        @if($value->guide_se->guide_type ?? '')
                                            @php
                                                $guideTypes = explode(',', $value->guide_se->guide_type);
                                            @endphp
                                            {{ implode(', ', $guideTypes) }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="suther">{{ \Carbon\Carbon::parse($value->created_at)->format('d F Y') }}</td>
                                      <td class="suther">
                                            @if($value->status == 0)
                                                Pending
                                            @elseif($value->status == 1)
                                                Complete
                                            @elseif($value->status == 2)
                                                Reject
                                            @elseif($value->status == 3)
                                                Under Inquiry
                                            @else
                                                Under Process
                                            @endif
                                        </td>
                                        <td class="suther">
                                            @if($value->status == 0 || $value->status == 2 || $value->status == 1)
                                                <!-- No action for Pending, Reject, or Complete -->
                                            @else
                                                {{-- <button style="width: 100%;" class="btn btn-primary suther" data-bs-toggle="modal" data-bs-target="#guideDetailsModal3001{{ $value->id }}" onclick="setBookingId({{ $value->id }})">Enter Details</button> --}}
                                                 <a href="{{ route('tourists.create', [$value->id, 'Guide']) }}" class="btn btn-primary btn-sm">
                                                    Enter Details
                                                </a>
                                            @endif
                                        </td>
                                        <td class="suther">
                                            @if($value->status == 0 || $value->status == 2)
                                                <!-- No tourist list for Pending or Reject -->
                                            @else
                                                <button class="btn btn-secondary suther" data-bs-toggle="modal" data-bs-target="#guideTouristListModal3001{{ $value->id }}" onclick="showTouristList({{ $value->id }})">View List</button>
                                            @endif
                                        </td>
                                        {{-- <th class="suther">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#hotelPreferenceModal2001{{ $value->id }}">Hotel Preference</button>
                                        </th> --}}
                                        {{-- <td class="suther">
                                            @if($value->status == 0 || $value->status == 2 || $value->status == 1)
                                                <!-- No upgrade request for Pending, Reject, or Complete -->
                                            @else
                                                <button class="btn btn-warning suther" data-bs-toggle="modal" data-bs-target="#hotelUpgradeRequestModal2001{{ $value->id }}">Request Upgrade</button>
                                            @endif
                                        </td> --}}
                                        <td class="suther">
                                            @if($value->package->pdf ?? '')
                                                <button type="button" class="btn btn-primary mt-3" onclick="window.location.href='{{ route('pdf.download', ['user_id' => Auth::id(), 'booking_id' => $value->id, 'pdf_name' => urlencode(basename($value->package->pdf))]) }}'">Download PDF</button>
                                            @else
                                                <p>No PDF available for download.</p>
                                            @endif
                                        </td>
                                
                                <!-- Modals for Safari Booking #3001 -->
                                <!-- Safari Upgrade Request Modal -->
                                {{-- <div class="modal fade suther" id="taxiUpgradeRequestModal3001" tabindex="-1" aria-labelledby="taxiUpgradeRequestModalLabel3001" aria-hidden="true">
                                    <div class="modal-dialog modal-lg suther">
                                        <div class="modal-content suther">
                                            <div class="modal-header suther">
                                                <h5 class="modal-title suther" id="taxiUpgradeRequestModalLabel3001">Request Safari Upgrade</h5>
                                                <button type="button" class="btn-close suther" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body suther">
                                                <form action="/upgrade_request" class="suther" method="POST">
                                                    <h6 class="fw-bold suther">Upgrade Request Details</h6>
                                                    <div class="mb-3 suther">
                                                        <label for="bookingId" class="form-label suther">Booking ID</label>
                                                        <input name="booking_id" value="3001" type="text" class="form-control suther" readonly id="bookingId" placeholder="Enter Booking ID">
                                                    </div>
                                                    <div class="mb-3 suther">
                                                        <label for="upgradeDetails" class="form-label suther">Upgrade Details</label>
                                                        <textarea name="upgrade_details" class="form-control suther" id="upgradeDetails" rows="3" placeholder="Enter Upgrade Details"></textarea>
                                                    </div>
                                                    <div class="mb-3 suther">
                                                        <label for="upgradeNotes" class="form-label suther">Notes</label>
                                                        <textarea name="notes" class="form-control suther" id="upgradeNotes" rows="3" placeholder="Enter Notes (Optional)"></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-success suther">Submit Request</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <!-- Guide Tourist List Modal -->
                                <div class="modal fade suther" id="guideTouristListModal3001{{$value->id ?? ''}}" tabindex="-1" aria-labelledby="taxiTouristListModalLabel3001" aria-hidden="true">
                                    <div class="modal-dialog modal-lg suther">
                                        <div class="modal-content suther">
                                            <div class="modal-header suther">
                                                <h5 class="modal-title suther" id="taxiTouristListModalLabel3001">Tourist List for Guide Booking #{{$value->id ?? ''}}</h5>
                                                <button type="button" class="btn-close suther" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body suther">
                                                <div class="suther" id="touristListContainerguide">
                                                    <div class="tourist-table">
                                                        <div class="tourist-table-header">
                                                            <div class="tourist-table-cell fw-bold">Name</div>
                                                            <div class="tourist-table-cell fw-bold">Age</div>
                                                            <div class="tourist-table-cell fw-bold">Phone</div>
                                                        </div>
                                                       @foreach($value->tourists->where('type','Guide') as $tourist)
                                                                    <div class="tourist-table-row">
                                                                        <div class="tourist-table-cell">{{ $tourist->name }}</div>
                                                                        <div class="tourist-table-cell">{{ $tourist->age }}</div>
                                                                        <div class="tourist-table-cell">{{ $tourist->phone }}</div>
                                                                    </div>
                                                                @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Guide Details Modal -->
                                <div class="modal fade suther" id="guideDetailsModal3001{{$value->id ?? ''}}" tabindex="-1" aria-labelledby="guideDetailsModalLabel3001" aria-hidden="true">
                                    <div class="modal-dialog modal-lg suther">
                                        <div class="modal-content suther">
                                            <div class="modal-header suther">
                                                <h5 class="modal-title suther" id="safariDetailsModalLabel3001">Enter Guide Booking Details</h5>
                                                <button type="button" class="btn-close suther" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form enctype="multipart/form-data" method="POST" action="{{route('saveGuideTouristDetails')}}" class="suther" id="guideTouristForm{{ $value->id ?? '' }}">
                                                @csrf
                                                <div class="modal-body suther">
                                                    <input type="hidden" id="bookingIdss" name="booking_id" value="{{$value->id ?? ''}}">
                                                    <h6 class="fw-bold suther">Tourists Information</h6>
                                                    <div id="taxiTouristContainer{{ $value->id ?? '' }}" class="mb-3 suther">
                                                        <div class="tourist-section suther mb-4" data-tourist-id="1">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <h6 class="fw-bold suther">Tourist 1</h6>
                                                                <button type="button" class="btn btn-danger btn-sm remove-tourist suther" style="display: none;">Remove</button>
                                                            </div>
                                                            <div class="row mb-3 suther">
                                                                <div class="col-md-6 suther">
                                                                    <label for="touristName1" class="form-label suther">Name</label>
                                                                    <input type="text" class="form-control suther touristName" name="tourist[1][name]" id="touristName1" placeholder="Enter Name">
                                                                </div>
                                                                <div class="col-md-6 suther">
                                                                    <label for="touristAge1" class="form-label suther">Age</label>
                                                                    <input type="number" class="form-control suther touristAge" name="tourist[1][age]" id="touristAge1" placeholder="Enter Age">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3 suther">
                                                                <div class="col-md-6 suther">
                                                                    <label for="touristPhone1" class="form-label suther">Phone No.</label>
                                                                    <input type="text" class="form-control suther touristPhone" name="tourist[1][phone]" id="touristPhone1" placeholder="Enter Phone No.">
                                                                </div>
                                                                <div class="col-md-6 suther">
                                                                    <label for="aadharUploadFront1" class="form-label suther">Aadhaar Card (Front)</label>
                                                                    <input id="aadharUploadFront1" type="file" class="form-control suther touristAadharFront" name="tourist[1][aadhar_front]">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3 suther">
                                                                <div class="col-md-6 suther">
                                                                    <label for="aadharUploadBack1" class="form-label suther">Aadhaar Card (Back)</label>
                                                                    <input id="aadharUploadBack1" type="file" class="form-control suther touristAadharBack" name="tourist[1][aadhar_back]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-success suther mb-3" id="addTaxiTourist{{ $value->id ?? '' }}">Add Tourist</button>
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
                                <!-- Safari Hotel Preference Modal -->
                                <div class="modal fade" id="safariHotelPreferenceModal3001" tabindex="-1" aria-labelledby="safariHotelPreferenceModalLabel3001" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="safariHotelPreferenceModalLabel3001">Select Hotels</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="/hotel_prefrence" method="POST">
                                                <div class="modal-body">
                                                    <ul class="list-group">
                                                        <li class="list-group-item d-flex align-items-center row">
                                                            <div class="col-2">
                                                                <img src="hotel1.jpg" class="rounded me-3" alt="Hotel Image">
                                                            </div>
                                                            <div class="col-8" style="text-align: center; justify-content: center;">
                                                                <div class="flex-grow-1">
                                                                    <h6 class="mb-0">Grand Hotel</h6>
                                                                    <small>Deluxe ⭐⭐⭐ (3 star)</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-2" style="text-align: right;">
                                                                <label>
                                                                    <input type="checkbox" name="hotel_id[]" value="1" class="form-check-input ms-auto">
                                                                    <input type="hidden" name="booking_id" value="3001">
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center row">
                                                            <div class="col-2">
                                                                <img src="hotel2.jpg" class="rounded me-3" alt="Hotel Image">
                                                            </div>
                                                            <div class="col-8" style="text-align: center; justify-content: center;">
                                                                <div class="flex-grow-1">
                                                                    <h6 class="mb-0">Luxury Resort</h6>
                                                                    <small>Deluxe ⭐⭐⭐⭐⭐ (5 star)</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-2" style="text-align: right;">
                                                                <label>
                                                                    <input type="checkbox" disabled class="form-check-input ms-auto" />
                                                                    <span class="text-muted">Already Added</span>
                                                                    <input type="hidden" name="booking_id" value="3001">
                                                                </label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
            </div>
        </div>

        <!-- Wallet Tab -->
        <div class="tab-pane fade suther" id="wallet">
            <h5 class="fw-bold suther">Wallet</h5>
            <p class="suther">Manage your wallet balance and transactions.</p>
            <div class="row suther">
                <div class="col-md-6 suther">
                    <label class="fw-bold suther">Balance:</label>
                    <p class="suther">₹{{ $totalAmount->balance ?? '0' }}</p>
                </div>
                <div class="col-md-6 suther">
                    <label class="fw-bold suther">Last Transaction:</label>
                    <p class="suther">₹{{ $lastRechargeAmount->amount ?? '0' }} on {{ $lastRechargeDate->created_at ?? '' }}</p>
                    <a href="{{route('transcation_history')}}">View All Transaction</a>
                </div>
            </div>
            <div class="mt-3">
                <button style="width: 40%" class="btn btn-primary suther" data-bs-toggle="modal" data-bs-target="#refundRechargeModal">Refund/Recharge</button>
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
                        {{-- <form action="{{ route('wallet.store') }}" class="suther" method="POST">
                            @csrf
                            <h6 class="fw-bold suther">Refund/Recharge Details</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3 suther">
                                        <label for="transactionType" class="form-label suther">Transaction Type</label>
                                        <select name="transaction_type" class="form-control suther" id="transactionType">
                                            <option value="debit">Refund</option>
                                            <option value="credit">Recharge</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3 suther">
                                        <label for="amount" class="form-label suther">Amount</label>
                                        <input name="amount" type="number" class="form-control suther" id="amount" placeholder="Enter Amount">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 suther">
                                <label for="notes" class="form-label suther">Notes</label>
                                <textarea name="note" class="form-control suther" id="notes" rows="3" placeholder="Enter Notes (Optional)"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success suther">Submit</button>
                        </form> --}}

<form id="walletForm" class="suther">
    @csrf
    <h6 class="fw-bold suther">Refund/Recharge Details</h6>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3 suther">
                <label for="transactionType" class="form-label suther">Transaction Type</label>
                <select name="transaction_type" class="form-control suther" id="transactionType" required>
                    <option value="">-- Select Type --</option>
                    <option value="debit">Debit</option>
                    <option value="credit">Credit</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3 suther">
                <label for="amount" class="form-label suther">Amount</label>
                <input name="amount" type="number" class="form-control suther" id="amount" 
                       placeholder="Enter Amount" min="1" step="0.01" required>
            </div>
        </div>
    </div>

    <div class="mb-3 suther">
        <label for="notes" class="form-label suther">Notes (Optional)</label>
        <textarea name="note" class="form-control suther" id="notes" rows="3" 
                  placeholder="Enter Notes"></textarea>
    </div>

    <button type="submit" id="submitBtn" class="btn btn-success suther btn-lg px-5">
        <span id="btnDefault">
            <i class="fas fa-paper-plane me-2"></i> Submit Transaction
        </span>
        <span id="btnProcessing" class="d-none">
            <i class="fas fa-spinner fa-spin"></i> Processing...
        </span>
    </button>
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


<!-- Scripts -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// CSRF Token
const csrfToken = '{{ csrf_token() }}';

document.getElementById('walletForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const type = formData.get('transaction_type');
    const amount = formData.get('amount');

    if (!type || !amount || amount <= 0) {
        Swal.fire('Invalid Input', 'Please select type and enter valid amount.', 'warning');
        return;
    }

    const btnDefault = document.getElementById('btnDefault');
    const btnProcessing = document.getElementById('btnProcessing');
    const submitBtn = document.getElementById('submitBtn');

    btnDefault.classList.add('d-none');
    btnProcessing.classList.remove('d-none');
    submitBtn.disabled = true;

    try {
        const response = await fetch('{{ route('wallet.store') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: formData
        });

        const result = await response.json();

        if (response.ok && result.status === 200) {

            if (type === 'debit') {
                // Debit Success → Direct
                Swal.fire({
                    icon: 'success',
                    title: 'Your refund request has been sent to the admin successfully!',
                    text: `₹${amount} debited from wallet.`,
                    timer: 2500,
                    showConfirmButton: false
                }).then(() => location.reload());

            } else if (type === 'credit') {
                // Credit → Open Razorpay
                openRazorpay(result.data);
            }

        } else {
            Swal.fire('Failed', result.message || 'Something went wrong!', 'error');
        }

    } catch (err) {
        Swal.fire('Error', 'Network issue. Please try again.', 'error');
    } finally {
        btnDefault.classList.remove('d-none');
        btnProcessing.classList.add('d-none');
        submitBtn.disabled = false;
    }
});

// Razorpay Open
function openRazorpay(data) {
    const options = {
        key: '{{ env('RAZORPAY_KEY') }}',
        amount: data.razorpay_order.amount,
        currency: 'INR',
        name: 'Wallet Recharge',
        description: 'Add money to your wallet',
        order_id: data.razorpay_order.id,
        handler: function (response) {
            verifyPayment(response, data.transaction_id);
        },
        prefill: {
            name: '{{ Auth::guard('agent')->user()->name }}',
            email: '{{ Auth::guard('agent')->user()->email }}',
            contact: '{{ Auth::guard('agent')->user()->number ?? "" }}'
        },
        theme: { color: '#28a745' },
        modal: {
            ondismiss: function() {
                Swal.fire('Payment Cancelled', 'You closed the payment window.', 'info');
            }
        }
    };

    const rzp = new Razorpay(options);
    rzp.open();
}

// Verify Payment
async function verifyPayment(response, transactionId) {
    const verifyRes = await fetch('{{ route('wallet.razorpay.callback') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            razorpay_payment_id: response.razorpay_payment_id,
            razorpay_order_id: response.razorpay_order_id,
            razorpay_signature: response.razorpay_signature,
            wallet_transaction_id: transactionId
        })
    });

    const result = await verifyRes.json();

    if (result.status === 200) {
        Swal.fire({
            icon: 'success',
            title: 'Payment Successful!',
            text: `₹${result.data.transaction.amount} added to your wallet!`,
            timer: 3000,
            showConfirmButton: false
        }).then(() => location.reload());
    } else {
        Swal.fire('Payment Failed', result.message || 'Verification failed', 'error');
    }
}
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script>
    function downloadPDF(pdfUrl) {
        window.open(pdfUrl, '_blank');
    }

    function setBookingId(bookingId) {
        document.getElementById('bookingIdss').value = bookingId;
    }

    const touristData = {
        1001: [
            { name: 'Alice Smith', age: 30, phone: '+1 123 456 7890' },
            { name: 'Bob Johnson', age: 35, phone: '+1 987 654 3210' }
        ],
        2001: [
            { name: 'David Wilson', age: 40, phone: '+1 555 123 4567' },
            { name: 'Emma Davis', age: 25, phone: '+1 555 987 6543' }
        ],
        3001: [
            { name: 'Frank Miller', age: 32, phone: '+1 444 123 4567' }
        ]
    };

    function showTouristList(bookingId) {
        const touristList = touristData[bookingId] || [];
        const container = document.getElementById('touristListContainer');
        container.innerHTML = '';

        if (touristList.length > 0) {
            container.innerHTML = '<div class="tourist-table"><div class="tourist-table-header"><div class="tourist-table-cell fw-bold">Name</div><div class="tourist-table-cell fw-bold">Age</div><div class="tourist-table-cell fw-bold">Phone</div></div>';
            touristList.forEach(tourist => {
                container.innerHTML += `
                    <div class="tourist-table-row">
                        <div class="tourist-table-cell">${tourist.name}</div>
                        <div class="tourist-table-cell">${tourist.age}</div>
                        <div class="tourist-table-cell">${tourist.phone}</div>
                    </div>
                `;
            });
            container.innerHTML += '</div>';
        } else {
            container.innerHTML = '<p>No tourist details available for this booking.</p>';
        }
    }

    $(document).ready(function() {
        const touristFormConfigs = [];

        @foreach($booking as $value)
            touristFormConfigs.push({
                addButtonId: 'addTourist{{ $value->id }}',
                containerId: 'touristContainer{{ $value->id }}',
                formId: 'touristForm{{ $value->id }}',
                modalId: 'packageDetailsModal{{ $value->id }}',
                ajax: true
            });
        @endforeach

        @foreach($hotels_data as $value)
            touristFormConfigs.push({
                addButtonId: 'addHotelTourist{{ $value->id }}',
                containerId: 'hotelTouristContainer{{ $value->id }}',
                formId: 'hotelTouristForm{{ $value->id }}'
            });
        @endforeach

        @foreach($WildlifeSafari_data as $value)
            touristFormConfigs.push({
                addButtonId: 'addSafariTourist{{ $value->id }}',
                containerId: 'safariTouristContainer{{ $value->id }}',
                formId: 'safariTouristForm{{ $value->id }}'
            });
        @endforeach

        @foreach($Taxi_data as $value)
            touristFormConfigs.push({
                addButtonId: 'addTaxiTourist{{ $value->id }}',
                containerId: 'taxiTouristContainer{{ $value->id }}',
                formId: 'taxiTouristForm{{ $value->id }}'
            });
        @endforeach

        touristFormConfigs.forEach(config => initDynamicTouristForm(config));
    });

    function initDynamicTouristForm(config) {
        const container = $('#' + config.containerId);
        const addButton = $('#' + config.addButtonId);

        if (!container.length || !addButton.length) {
            return;
        }

        addButton.on('click', function() {
            const newIndex = container.find('.tourist-section').length + 1;
            container.append(getTouristSectionTemplate(newIndex));
            updateRemoveButtons(container);
        });

        container.on('click', '.remove-tourist', function() {
            $(this).closest('.tourist-section').remove();
            updateTouristNumbers(container);
            updateRemoveButtons(container);
        });

        updateRemoveButtons(container);

        if (config.ajax && config.formId && config.modalId) {
            const form = $('#' + config.formId);

            form.on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        alert('Tourist details saved successfully!');
                        $('#' + config.modalId).modal('hide');
                        form.trigger('reset');
                        container.find('.tourist-section').not(':first').remove();
                        updateTouristNumbers(container);
                        updateRemoveButtons(container);
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred while saving tourist details');
                        console.log('Status: ' + status);
                        console.log('Error: ' + error);
                        console.log('Response Text: ' + xhr.responseText);
                    }
                });
            });
        }
    }

    function getTouristSectionTemplate(index) {
        return `
            <div class="tourist-section suther mb-4" data-tourist-id="${index}">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold suther">Tourist ${index}</h6>
                    <button type="button" class="btn btn-danger btn-sm remove-tourist suther">Remove</button>
                </div>
                <div class="row mb-3 suther">
                    <div class="col-md-6 suther">
                        <label for="touristName${index}" class="form-label suther">Name</label>
                        <input type="text" class="form-control suther touristName" name="tourist[${index}][name]" id="touristName${index}" placeholder="Enter Name">
                    </div>
                    <div class="col-md-6 suther">
                        <label for="touristAge${index}" class="form-label suther">Age</label>
                        <input type="number" class="form-control suther touristAge" name="tourist[${index}][age]" id="touristAge${index}" placeholder="Enter Age">
                    </div>
                </div>
                <div class="row mb-3 suther">
                    <div class="col-md-6 suther">
                        <label for="touristPhone${index}" class="form-label suther">Phone No.</label>
                        <input type="text" class="form-control suther touristPhone" name="tourist[${index}][phone]" id="touristPhone${index}" placeholder="Enter Phone No.">
                    </div>
                    <div class="col-md-6 suther">
                        <label for="aadharUploadFront${index}" class="form-label suther">Aadhaar Card (Front)</label>
                        <input id="aadharUploadFront${index}" type="file" class="form-control suther touristAadharFront" name="tourist[${index}][aadhar_front]">
                    </div>
                </div>
                <div class="row mb-3 suther">
                    <div class="col-md-6 suther">
                        <label for="aadharUploadBack${index}" class="form-label suther">Aadhaar Card (Back)</label>
                        <input id="aadharUploadBack${index}" type="file" class="form-control suther touristAadharBack" name="tourist[${index}][aadhar_back]">
                    </div>
                </div>
            </div>
        `;
    }

    function updateTouristNumbers(container) {
        const touristSections = container.find('.tourist-section');
        touristSections.each((index, section) => {
            const newId = index + 1;
            const $section = $(section);
            $section.attr('data-tourist-id', newId);
            $section.find('h6').first().text(`Tourist ${newId}`);
            const inputs = $section.find('input');
            inputs.eq(0).attr({ name: `tourist[${newId}][name]`, id: `touristName${newId}` });
            inputs.eq(1).attr({ name: `tourist[${newId}][age]`, id: `touristAge${newId}` });
            inputs.eq(2).attr({ name: `tourist[${newId}][phone]`, id: `touristPhone${newId}` });
            inputs.eq(3).attr({ name: `tourist[${newId}][aadhar_front]`, id: `aadharUploadFront${newId}` });
            inputs.eq(4).attr({ name: `tourist[${newId}][aadhar_back]`, id: `aadharUploadBack${newId}` });
            const labels = $section.find('label');
            labels.eq(0).attr('for', `touristName${newId}`);
            labels.eq(1).attr('for', `touristAge${newId}`);
            labels.eq(2).attr('for', `touristPhone${newId}`);
            labels.eq(3).attr('for', `aadharUploadFront${newId}`);
            labels.eq(4).attr('for', `aadharUploadBack${newId}`);
        });
    }

    function updateRemoveButtons(container) {
        const removeButtons = container.find('.remove-tourist');
        removeButtons.toggle(container.find('.tourist-section').length > 1);
    }
</script> --}}

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[id^="addTourist"]').forEach(btn => {
        const bookingId = btn.id.replace('addTourist', '');
        const container = document.getElementById('touristContainer' + bookingId);
        let count = container.querySelectorAll('.tourist-section').length;

        btn.onclick = function () {
            count++;
            const html = `
                <div class="tourist-section border p-4 rounded mb-3 bg-light">
                    <div class="d-flex justify-content-between mb-3">
                        <h6 class="fw-bold text-primary">Tourist ${count}</h6>
                        <button type="button" class="btn btn-danger btn-sm remove-tourist">Remove</button>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" name="tourist[${count}][name]" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="col-md-6">
                            <input type="number" name="tourist[${count}][age]" class="form-control" placeholder="Age" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="tourist[${count}][phone]" class="form-control" placeholder="Phone" required>
                        </div>
                        <div class="col-md-6">
                            <input type="file" name="tourist[${count}][aadhar_front]" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="file" name="tourist[${count}][aadhar_back]" class="form-control">
                        </div>
                    </div>
                </div>`;
            container.insertAdjacentHTML('beforeend', html);
        };
    });

    // Remove button (default + dynamic)
    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-tourist')) {
            if (document.querySelectorAll('.tourist-section').length > 1) {
                e.target.closest('.tourist-section').remove();
            } else {
                alert('At least one tourist required!');
            }
        }
    });
});
</script>
@endsection
