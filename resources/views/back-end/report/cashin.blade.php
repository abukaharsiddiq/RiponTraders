@extends('back-end.master')

@section('admin-title')
Total CashIn
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
                    	<h1 class="card-title">Total CashIn</h1>
                    </div>
                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Date</th>
                          <th>Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                      	@php
                      	$i=1;
                        $sum=0;
                      	@endphp
                      	@foreach($lists as $info)
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ $info->date }}</td>
                          <td>{{ $info->amount }}</td>
                          @php
                            $sum+=$info->amount;
                          @endphp
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th></th>
                          <th>Total Amount: </th>
                          <td>{{ $sum }}</td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
@endsection

@push('admin-scripts')

@endpush