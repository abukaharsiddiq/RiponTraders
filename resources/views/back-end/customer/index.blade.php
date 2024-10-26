@extends('back-end.master')

@section('admin-title')
Manage Customer
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
                    	<h1 class="card-title">Manage Customer</h1>
                    </div>
                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Seller Or Buyer</th>
                          <th>Location Name</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Address</th>
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
                          <td>{{ $info->seller_buyer }}</td>
                          <td>{{ $info->customer_group->name??'' }}</td>
                          <td>{{ $info->name }}</td>
                          <td>{{ $info->phone }}</td>
                          <td>{{ $info->address??'' }}</td>
                          <td>

                          	<a href="{{ route('report.sale.history',['customer_group_id'=>$info->customer_group_id,'customer_id'=>$info->id]) }}" class="btn btn-sm btn-info">
                          		<i class="fa fa-eye"></i>
                          	</a>

                              <a href="{{ route('customer.edit',$info->id) }}" class="btn btn-sm btn-primary">
                              <i class="fa fa-edit"></i>
                            </a>

                          	<a href="{{ route('customer.delete',$info->id) }}" class="btn btn-sm btn-danger">
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