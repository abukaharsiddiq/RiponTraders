@extends('back-end.master')

@section('admin-title')
Sale Details
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
                        Sale Details
                        <a href="{{ route('sale.index') }}" class="btn btn-sm btn-primary">Back</a>
                      </h1>
                    </div>
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Product</th>
                          <th>Image</th>
                          <th>Unit Price</th>
                          <th>Quantity</th>
                          <th>Unit Total</th>
                        </tr>
                      </thead>
                      <tbody>
                      	@php
                      	$i=1
                      	@endphp
                      	@foreach($lists as $info)
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ $info->product->name }}</td>
                          <td>
                            <img src="{{ asset('/') }}back-end/product/{{ $info->product->image }}" style="width:50px; height:50px;">
                          </td>
                          <td>{{ $info->unit_price }}</td>
                          <td>{{ $info->quantity }}</td>
                          <td>{{ $info->unit_total }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

                   <div class="col-md-12">
                     <div class="col-md-4 offset-md-8">
                          <table class="table table-bordered">
                              <tr>
                                <th>Total Amount</th>
                                <td>{{ $sale }}</td>
                              </tr>

                               <tr>
                                <th>Paid Amount</th>
                                <td>{{ $payment->paid_amount }}</td>
                              </tr>

                               <tr>
                                <th>Due Amount</th>
                                <td>{{ $payment->due_amount }}</td>
                              </tr>

                          </table>
                     </div>
                   </div>

                </div>
              </div>
@endsection

@push('admin-scripts')

@endpush