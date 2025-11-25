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
                   <tr>
                <td style="padding: 10px;">2025-11-25</td>
                <td style="padding: 10px;">Salary Credited</td>
                <td style="padding: 10px; color: green; font-weight: bold;">CREDIT</td>
                <td style="padding: 10px;">₹ 25000</td>
            </tr>

            <tr>
                <td style="padding: 10px;">2025-11-23</td>
                <td style="padding: 10px;">ATM Withdrawal</td>
                <td style="padding: 10px; color: red; font-weight: bold;">DEBIT</td>
                <td style="padding: 10px;">₹ 2000</td>
            </tr>

            <tr>
                <td style="padding: 10px;">2025-11-22</td>
                <td style="padding: 10px;">UPI Payment - Grocery</td>
                <td style="padding: 10px; color: red; font-weight: bold;">DEBIT</td>
                <td style="padding: 10px;">₹ 850</td>
            </tr>

            <tr>
                <td style="padding: 10px;">2025-11-20</td>
                <td style="padding: 10px;">Refund Received</td>
                <td style="padding: 10px; color: green; font-weight: bold;">CREDIT</td>
                <td style="padding: 10px;">₹ 499</td>
            </tr>

            <tr>
                <td style="padding: 10px;">2025-11-18</td>
                <td style="padding: 10px;">Electricity Bill</td>
                <td style="padding: 10px; color: red; font-weight: bold;">DEBIT</td>
                <td style="padding: 10px;">₹ 1450</td>
            </tr>
        </tbody>
    </table>
</div>

<script>

</script>

@endsection
