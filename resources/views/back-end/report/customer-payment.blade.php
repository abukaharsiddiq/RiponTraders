@extends('back-end.master')

@section('admin-title')
Customer Payment
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
                    	<h1 class="card-title">Customer Payment</h1>
                    </div>
                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Customer</th>
                          <th>Total Amount</th>
                          <th>Paid Amount</th>
                          <th>Due Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                      	@php
                      	$i=1;
                        $sumTotal=0;
                        $sumPaid=0;
                        $sumDue=0;
                      	@endphp

                        @foreach($lists as $info)
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ $info['customer_name'] }}</td>
                          <td>{{ $info['total_amount'] }}</td>
                          <td>{{ $info['paid_amount'] }}</td>
                          <td>
                            @php
                             $totalAmount = $info['total_amount'];
                             $totalPaid = $info['paid_amount'];
                             $TotalDue = $totalAmount - $totalPaid;
                            @endphp
                            {{ $TotalDue }}
                          </td>
                            @php
                             $sumTotal+=$info['total_amount'];
                             $sumPaid+=$info['paid_amount'];
                             $sumDue+=$TotalDue;
                          @endphp
                        </tr>
                        @endforeach
           
                      </tbody>
                      <tfoot>
                        <tr>
                          <th></th>
                          <th></th>
                          <td>Total: {{ $sumTotal }}</td>
                          <td>Paid Amount: {{ $sumPaid }}</td>
                          <td>Due Amount: {{ $sumDue }}</td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
@endsection

@push('admin-scripts')

@endpush