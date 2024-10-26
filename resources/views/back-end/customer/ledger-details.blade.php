@extends('back-end.master')

@section('admin-title')
Customer Ledger
@endsection

@push('admin-styles')
<style>
	a.btn-primay{
		content:'';
		position: absolute;
		right: 0;
	}
</style>
@endpush

@section('admin-content')
<div class="card">
                <div class="card-body">
                  <div class="row mb-4">
                    	<h1 class="card-title">Customer Ledger</h1>
                    </div>
                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                       <thead>
                <tr>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ledgerEntries as $entry)
                    <tr>
                        <td>{{ $entry->date }}</td>
                        <td>{{ $entry->description }}</td>
                        <td>{{ number_format($entry->debit, 2) }}</td>
                        <td>{{ number_format($entry->credit, 2) }}</td>
                        <td>{{ number_format($entry->running_balance, 2) }}</td>
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