@extends('back-end.master')

@section('admin-title')
Director Payment
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
                    	<h1 class="card-title">Director Payment</h1>
                    </div>
                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Director</th>
                          <th>Date</th>
                          <th>Month</th>
                          <th>Amount</th>
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
                          <td>{{ $info->director->name }}</td>
                          <td>{{ $info->date }}</td>
                          <td>{{ $info->pay_month }}</td>
                          <td>{{ $info->amount }}</td>
                          <td>

                            <a href="{{ route('director-payment.edit',$info->id) }}" class="btn btn-sm btn-primary">
                              <i class="fa fa-edit"></i>
                            </a>

                          	<a href="{{ route('director-payment.delete',$info->id) }}" class="btn btn-sm btn-danger">
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