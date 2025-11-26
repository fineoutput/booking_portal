@extends('front.common.app')
@section('title', 'Agent Profile')
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4>Add Tourists - Booking ID: {{ $bookingId }}</h4>
                </div>
                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('tourists.store', $bookingId) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-bold">Additional Information (Optional)</label>
                            <textarea name="additional_info" class="form-control" rows="3" placeholder="Any notes..."></textarea>
                        </div>

                        <div id="touristContainer">
                            <!-- Pehla tourist by default -->
                            <div class="tourist-row border rounded p-4 mb-4 bg-light position-relative">
                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2" onclick="this.parentElement.remove()">
                                    ×
                                </button>
                                <h5 class="text-primary mb-3">Tourist 1</h5>
                                <div class="row g-3">
                                    <div class="col-md-4"><input type="text" name="tourists[0][name]" class="form-control" placeholder="Name" required></div>
                                    <div class="col-md-4"><input type="number" name="tourists[0][age]" class="form-control" placeholder="Age" required></div>
                                    <div class="col-md-4"><input type="text" name="tourists[0][phone]" class="form-control" placeholder="Phone" required></div>
                                    <div class="col-md-6"><input type="file" name="tourists[0][aadhar_front]" class="form-control"></div>
                                    <div class="col-md-6"><input type="file" name="tourists[0][aadhar_back]" class="form-control"></div>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-success" onclick="addMoreTourist()">
                            Add Another Tourist
                        </button>

                        <hr class="my-4">
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            Save All Tourists
                        </button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg px-5">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let touristIndex = 1;

function addMoreTourist() {
    const container = document.getElementById('touristContainer');
    const html = `
        <div class="tourist-row border rounded p-4 mb-4 bg-light position-relative">
            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2" onclick="this.parentElement.remove()">
                ×
            </button>
            <h5 class="text-primary mb-3">Tourist ${touristIndex + 1}</h5>
            <div class="row g-3">
                <div class="col-md-4"><input type="text" name="tourists[${touristIndex}][name]" class="form-control" placeholder="Name" required></div>
                <div class="col-md-4"><input type="number" name="tourists[${touristIndex}][age]" class="form-control" placeholder="Age" required></div>
                <div class="col-md-4"><input type="text" name="tourists[${touristIndex}][phone]" class="form-control" placeholder="Phone" required></div>
                <div class="col-md-6"><input type="file" name="tourists[${touristIndex}][aadhar_front]" class="form-control"></div>
                <div class="col-md-6"><input type="file" name="tourists[${touristIndex}][aadhar_back]" class="form-control"></div>
            </div>
        </div>`;
    container.insertAdjacentHTML('beforeend', html);
    touristIndex++;
}

// Page load hone pe ek tourist to hona hi chahiye
document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelectorAll('.tourist-row').length === 0) {
        addMoreTourist();
    }
});
</script>
@endsection