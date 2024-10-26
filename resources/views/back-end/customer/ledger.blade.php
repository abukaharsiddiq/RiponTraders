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
                          <th>SN</th>
                          <th>Name</th>
                          <th>Phone</th>
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
                          <td>{{ $info->name }}</td>
                          <td>{{ $info->phone }}</td>
                          <td>
                          	<a href="{{ route('customer.ledger.details',$info->id) }}" class="btn btn-sm btn-info">
                          		<i class="fa fa-eye"></i>
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