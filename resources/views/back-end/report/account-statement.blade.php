@extends('back-end.master')

@section('admin-title')
Account Statement
@endsection

@push('admin-styles')
<style>
	body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f8f8;
}

.statement-container {
    background-color: #ffffff;
    padding: 20px;
    border: 1px solid #ccc;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

.balance-info {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
    font-size: 16px;
}

.statement-table {
    width: 100%;
    border-collapse: collapse;
}

.statement-table th,
.statement-table td {
    padding: 8px 12px;
    border: 1px solid #ddd;
    text-align: left;
    font-size: 14px;
}

.statement-table th {
    background-color: #f2f2f2;
    text-align: center;
}

.statement-table td:nth-child(1),
.statement-table td:nth-child(2),
.statement-table td:nth-child(3),
.statement-table td:nth-child(4),
.statement-table td:nth-child(5) {
    text-align: center;
}

.statement-table td:nth-child(2) a {
    color: #007bff;
    text-decoration: none;
}

.statement-table td:nth-child(2) a:hover {
    text-decoration: underline;
}

</style>
@endpush

@section('admin-content')
<div class="card">
    <div class="card-body">
        <div class="statement-container">
            <h2>Account Statement</h2>
            <div class="filter-form mb-4">
                <form action="{{ route('report.account.statement') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="date" name="date">
                        <button class="btn btn-sm btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <div class="balance-info">
                <span>Balance: {{ $lastBalance }} /-</span>
                <span>Date: {{ request('date') ? \Carbon\Carbon::parse(request('date'))->format('d/m/Y') : \Carbon\Carbon::today()->format('d/m/Y') }}</span>
            </div>
            <table class="statement-table">
                <thead>
                    <tr>
                        <th>Particulars</th>
                        <th>Memo no/Reason</th>
                        <th>Withdraw</th>
                        <th>Deposit</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($todaysTransaction as $info)
                    <tr>
                        <td>{{ $info->transaction_type ?? '' }}/{{ $info->customer_group->name ?? '' }}/{{ $info->customer->name ?? '' }}</td>
                        <td>{{ $info->reason ?? $info->memo_no ?? '' }}</td>
                        <td>{{ $info->debit ?? '' }}</td>
                        <td>{{ $info->credit ?? '' }}</td>
                        <td>{{ $info->balance ?? '' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('admin-scripts')

@endpush