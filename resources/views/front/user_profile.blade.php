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
                    <p class="suther">John Doe</p>
                </div>
                <div class="col-md-6 suther">
                    <label class="fw-bold suther">Email:</label>
                    <p class="suther">johndoe@example.com</p>
                </div>
                <div class="col-md-6 suther">
                    <label class="fw-bold suther">Phone:</label>
                    <p class="suther">+1 123 456 7890</p>
                </div>
                <div class="col-md-6 suther">
                    <label class="fw-bold suther">Address:</label>
                    <p class="suther">123 Main St, Anytown, USA</p>
                </div>
            </div>
        </div>

        <!-- Bookings Tab -->
        <div class="tab-pane fade suther" id="bookings">
            <h5 class="fw-bold suther">Bookings</h5>
            <p class="suther">View your booking history and manage reservations.</p>
            <!-- Bookings Details Section -->
            <div class="table-responsive">
            <table class="table table-striped suther">
                <thead class="suther">
                    <tr class="suther">
                        <th class="suther">#</th>
                        <th class="suther">Booking ID</th>
                        <th class="suther">Service</th>
                        <th class="suther">Date</th>
                        <th class="suther">Status</th>
                        <th class="suther">Action</th>
                    </tr>
                </thead>
                <tbody class="suther">
                    <tr class="suther">
                        <td class="suther">1</td>
                        <td class="suther">12345</td>
                        <td class="suther">Hotel Stay</td>
                        <td class="suther">2024-12-20</td>
                        <td class="suther">Confirmed</td>
                        <td class="suther">
                            <button class="btn btn-primary suther" data-bs-toggle="modal" data-bs-target="#packageDetailsModal">Enter Details</button>
                        </td>
                    </tr>
                    <tr class="suther">
                        <td class="suther">2</td>
                        <td class="suther">67890</td>
                        <td class="suther">Car Rental</td>
                        <td class="suther">2024-12-18</td>
                        <td class="suther">Completed</td>
                        <td class="suther">
                            <button class="btn btn-primary suther" data-bs-toggle="modal" data-bs-target="#packageDetailsModal">Enter Details</button>
                        </td>
                    </tr>
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
                    <div class="mb-3 suther">
                        <label for="transactionType" class="form-label suther">Transaction Type</label>
                        <select class="form-control suther" id="transactionType">
                            <option value="refund">Refund</option>
                            <option value="recharge">Recharge</option>
                        </select>
                    </div>
                    <div class="mb-3 suther">
                        <label for="amount" class="form-label suther">Amount</label>
                        <input type="number" class="form-control suther" id="amount" placeholder="Enter Amount">
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
<div class="modal fade suther" id="packageDetailsModal" tabindex="-1" aria-labelledby="packageDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg suther">
        <div class="modal-content suther">
            <div class="modal-header suther">
                <h5 class="modal-title suther" id="packageDetailsModalLabel">Enter Package Details</h5>
                <button type="button" class="btn-close suther" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body suther">
                <form class="suther">
                    <h6 class="fw-bold suther">Tourists Information</h6>
                    <div class="mb-3 suther">
                        <label for="touristName" class="form-label suther">Name</label>
                        <input type="text" class="form-control suther" id="touristName" placeholder="Enter Name">
                    </div>
                    <div class="mb-3 suther">
                        <label for="touristAge" class="form-label suther">Age</label>
                        <input type="number" class="form-control suther" id="touristAge" placeholder="Enter Age">
                    </div>
                    <div class="mb-3 suther">
                        <label for="touristPhone" class="form-label suther">Phone No.</label>
                        <input type="text" class="form-control suther" id="touristPhone" placeholder="Enter Phone No.">
                    </div>
                    <div class="mb-3 suther">
                        <label for="aadharUpload" class="form-label suther">Aadhar Upload</label>
                        <input type="file" class="form-control suther" id="aadharUpload">
                    </div>
                    <h6 class="fw-bold suther">Driver Details</h6>
                    <div class="mb-3 suther">
                        <label for="driverDetails" class="form-label suther">Details</label>
                        <textarea class="form-control suther" id="driverDetails" rows="3" placeholder="Enter Details"></textarea>
                    </div>
                    <h6 class="fw-bold suther">Hotel Information</h6>
                    <div class="mb-3 suther">
                        <label for="hotelDetails" class="form-label suther">Details</label>
                        <textarea class="form-control suther" id="hotelDetails" rows="3" placeholder="Enter Details"></textarea>
                    </div>
                    <h6 class="fw-bold suther">Additional Information</h6>
                    <div class="mb-3 suther">
                        <label for="additionalInfo" class="form-label suther">Details</label>
                        <textarea class="form-control suther" id="additionalInfo" rows="3" placeholder="Enter Additional Information"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer suther">
                <button type="button" class="btn btn-secondary suther" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary suther">Save Changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
