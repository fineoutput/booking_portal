@extends('front.common.app')
@section('title', 'Agent Profile')
@section('content')
<style>
    .controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

#search {
    padding: 8px 12px;
    width: 250px;
    border: 1px solid #aaa;
    border-radius: 5px;
}

.filters {
    display: flex;
    gap: 10px;
}

.filter-btn {
    padding: 8px 15px;
    border: none;
    border-radius: 6px;
    background: #ddd;
    cursor: pointer;
    font-weight: bold;
}

.filter-btn.active {
    background: #007bff;
    color: white;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

table th, table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #eee;
}

.credit {
    color: green;
    font-weight: bold;
}

.debit {
    color: red;
    font-weight: bold;
}

@media (max-width: 600px) {
    .controls {
        flex-direction: column;
        align-items: stretch;
        gap: 10px;
    }

    #search {
        width: 100%;
    }
}
</style>
<div class="container">
    <h2>Transaction History</h2>

    <div class="controls">
        <input type="text" id="search" placeholder="Search transactions...">

        <div class="filters">
            <button class="filter-btn active" data-type="all">All</button>
            <button class="filter-btn" data-type="credit">Credit</button>
            <button class="filter-btn" data-type="debit">Debit</button>
        </div>
    </div>

<table id="transactionTable">
    <thead>
        <tr>
            <th>Date</th>
            <th>Details</th>
            <th>Type</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody id="tableBody">
        @foreach ($transactions as $t)
        <tr>
            <td style="padding: 10px;">{{ $t->created_at->format('Y-m-d') }}</td>

            <td style="padding: 10px;">{{ $t->note ?? 'N/A' }}</td>

            <td style="padding: 10px; font-weight: bold; color: {{ $t->transaction_type == 'credit' ? 'green' : 'red' }}">
                {{ strtoupper($t->transaction_type) }}
            </td>

            <td style="padding: 10px;">₹ {{ number_format($t->amount, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Pagination --}}
<div class="mt-3">
    {{ $transactions->onEachSide(1)->links('pagination::bootstrap-5') }}
</div>
</div>

<script>

</script>

@endsection
