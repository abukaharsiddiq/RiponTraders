@extends('back-end.master')

@section('admin-title')
Sales History
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
                    	<h1 class="card-title">
                      Sales History   
                    @if(isset($customer_group_name) && isset($customer_name))
                        <span class="text-danger" style="margin-left:10px;font-size: 14px;">
                            {{ $customer_group_name }} > {{ $customer_name }}
                        </span>
                    @endif

                    </h1>
                    </div>
                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Order No</th>
                          <th>Total Amount</th>
                          <th>Paid Amount</th>
                          <th>Balance</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                        $totalAmount=0;
                        $totalPaidAmount=0;
                        @endphp
                           @foreach($lists as $info)
                           <tr>
                             <td>{{ $info['date'] }}</td>
                             <td>
                              <a href="{{ route('report.sale.print',$info['order_id']) }}">
                              {{ $info['order_no'] }}
                              </a>
                             </td>
                             <td>{{ $info['total_amount'] }}</td>
                             <td>{{ $info['paid_amount'] }}</td>
                             <td>{{ $info['balance'] }}</td>

                             @php
                             $totalAmount+=$info['total_amount'];
                             $totalPaidAmount+=$info['paid_amount'];
                             @endphp
                           </tr>
                           @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <td></td>
                          <td></td>
                          <td>Total Amount: {{ $totalAmount }}</td>
                          <td>Total Paid: {{ $totalPaidAmount }}</td>
                          <td>Balance: {{ $totalAmount - $totalPaidAmount }}</td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
@endsection

@push('admin-scripts')

@endpush