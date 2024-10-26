@extends('back-end.master')

@section('admin-title')
Customer Due Amount
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
                    	<h1 class="card-title">Customer Due Amount</h1>
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
                          <th>Phone No</th>
                          <th>Due Amount</th>
                          <th>Action</th>
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
                          <td>{{ $info['customer_name'] }}</td>
                          <td>{{ $info['customer_phone'] }}</td>
                          <td>{{ $info['total_due'] }}</td>
                          
                          @php
                            $sum+=$info['total_due'];
                          @endphp
                          <td>
                              <a href="" class="btn btn-sm btn-primary">
                              <i class="fa fa-edit"></i>
                            </a>
                            <a href="" class="btn btn-sm btn-danger">
                              <i class="fa fa-trash"></i>
                            </a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th></th>
                          <th></th>
                          <th>Total Due Amount: </th>
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