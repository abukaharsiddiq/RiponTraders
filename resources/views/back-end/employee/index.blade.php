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
                    	<h1 class="card-title">Manage Employee</h1>
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
                          <th>Father</th>
                          <th>Phone</th>
                          <th>Address</th>
                          <th>Salary</th>
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
                          <td>{{ $info->employee_group->name }}</td>
                          <td>{{ $info->name }}</td>
                          <td>{{ $info->father_name }}</td>
                          <td>{{ $info->phone }}</td>
                          <td>{{ $info->address }}</td>
                          <td>{{ $info->salary }}</td>
                          <td>
                          	<a href="{{ route('employee.edit',$info->id) }}" class="btn btn-sm btn-primary">
                          		<i class="fa fa-edit"></i>
                          	</a>
                          	<a href="{{ route('employee.delete',$info->id) }}" class="btn btn-sm btn-danger">
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