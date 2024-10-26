@extends('back-end.master')

@section('admin-title')
Manage CashOut
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
                    	<h1 class="card-title">Manage CashOut</h1>
                    </div>
                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Payment Type</th>
                          <th>Bank Name</th>
                          <th>CashInType</th>
                          <th>Customer Group</th>
                          <th>Customer</th>
                          <th>Reason</th>
                          <th>Amount</th>
                          <th>Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      	@php
                      	$i=1
                      	@endphp
                      	@foreach($lists as $info)
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ $info->payment_type }}</td>
                          <td>{{ $info->bank_information->name??'' }}</td>
                          <td>{{ $info->cash_in_type->name??"" }}</td>
                          <td>{{ $info->customer_group->name??"" }}</td>
                          <td>{{ $info->customer->name??"" }}</td>
                          <td>{{ $info->reason }}</td>
                          <td>{{ $info->amount }}</td>
                          <td>{{ $info->date }}</td>
                          <td>
                          	<a href="{{ route('cashout.edit',$info->id) }}" class="btn btn-sm btn-primary">
                          		<i class="fa fa-edit"></i>
                          	</a>
                          	<a href="{{ route('cashout.delete',$info->id) }}" class="btn btn-sm btn-danger">
                          		<i class="fa fa-trash"></i>
                          	</a>
                          </td>
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