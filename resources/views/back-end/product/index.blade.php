@extends('back-end.master')

@section('admin-title')
Manage Product
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
                    	<h1 class="card-title">Manage Product</h1>
                    </div>
                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Group</th>
                          <th>Name</th>
                          <th>Barcode</th>
                          <th>Image</th>
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
                          <td>{{ $info->product_group->name }}</td>
                          <td>
                            <a href="{{ route('report.product.history',$info->id) }}">
                              {{ $info->name }}
                            </a>
                          </td>
                          <td>{{ $info->barcode }}</td>
                          <td>
                            <img src="{{ asset('/') }}back-end/product/{{ $info->image }}" style="width:50px;height: 50px;">
                          </td>
                          <td>
                          	<a href="{{ route('product.edit',$info->id) }}" class="btn btn-sm btn-primary">
                          		<i class="fa fa-edit"></i>
                          	</a>
                          	<a href="{{ route('product.delete',$info->id) }}" class="btn btn-sm btn-danger">
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