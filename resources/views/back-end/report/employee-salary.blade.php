@extends('back-end.master')

@section('admin-title')
Manage Employee
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
                    	<h1 class="card-title">{{ $currentMonthName }} Salary</h1>
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
                          <th>Salary</th>
                          <th>Advance</th>
                          <th>Balance</th>
                        </tr>
                      </thead>
                      <tbody>
                      	@php
                      	$i=1
                      	@endphp
                      	@foreach($lists as $info)
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ $info['employee_name'] }}</td>
                          <td>{{ $info['employee_phone'] }}</td>
                          <td>{{ $info['employee_salary'] }}</td>
                          <td>{{ $info['advance_amount'] }}</td>
                          <td>{{ $info['employee_salary']-$info['advance_amount'] }}</td>
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