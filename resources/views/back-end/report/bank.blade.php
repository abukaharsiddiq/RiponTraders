@extends('back-end.master')

@section('admin-title')
Sale Bank
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
                    	<h1 class="card-title">Sale Bank</h1>
                    </div>
                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Order No</th>
                          <th>Paid Amount</th>
                          <th>Due Amount</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
                      	@php
                      	$i=1;
                        $sumPaid=0;
                        $sumDue=0;
                      	@endphp
                      	@foreach($bankSales as $info)
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ $info->order_no }}</td>
                          <td>{{ $info->paid_amount }}</td>
                          <td>{{ $info->due_amount }}</td>
                          <td>{{ $info->date }}</td>
                          @php
                          $sumPaid+=$info->paid_amount;
                          $sumDue+=$info->due_amount;
                          @endphp
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th></th>
                          <th></th>
                          <td>Total Paid: {{ $sumPaid }}</td>
                          <td>Total Due: {{ $sumDue }}</td>
                          <td></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
@endsection

@push('admin-scripts')

@endpush