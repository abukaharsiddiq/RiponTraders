@extends('back-end.master')

@section('admin-title')
Manage Sale
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
                    	<h1 class="card-title">Manage Sale</h1>
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
                          <th>Order No</th>
                          <th>Group</th>
                          <th>Name</th>
                          <th>Total Amount</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      	@php
                      	$i=1;
                        $sum=0;
                      	@endphp
                      	@foreach($sales as $info)
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ $info->date }}</td>
                          <td>{{ $info->order_no }}</td>
                          <td>{{ $info->customer_group->name }}</td>
                          <td>{{ $info->customer->name }}</td>
                          <td>{{ $info->total_amount }}</td>

                           @php
                             $sum+=$info->total_amount;
                           @endphp

                          <td>

                            <a href="{{ route('report.sale.print',$info->id) }}" class="btn btn-sm btn-info">
                              <i class="fa fa-print"></i>
                            </a>

                             <a href="{{ route('sale.details',$info->id) }}" class="btn btn-sm btn-success">
                              <i class="fa fa-eye"></i>
                            </a>

                          	<a href="{{ route('sale.edit',$info->id) }}" class="btn btn-sm btn-primary">
                          		<i class="fa fa-edit"></i>
                          	</a>

                          	<a href="{{ route('sale.delete',$info->id) }}" class="btn btn-sm btn-danger">
                          		<i class="fa fa-trash"></i>
                          	</a>

                          </td>
                        </tr>
                        @endforeach
                        <tfoot>
                          <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total:</td>
                            <td>{{ $sum }}</td>
                            <td></td>
                          </tr>
                        </tfoot>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
@endsection

@push('admin-scripts')

@endpush