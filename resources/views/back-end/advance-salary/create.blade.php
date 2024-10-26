
@extends('back-end.master')

@section('admin-title')
Add Advance Salary
@endsection

@push('admin-styles')
<style>
	
</style>
@endpush

@section('admin-content')
 <div class="row">
 	<div class="col-md-12">
 		<div class="card">
                <form class="form-horizontal" action="{{ route('advance-salary.store') }}" method="POST">
                	@csrf
                  <div class="card-body">
                    <div class="row mb-4">
                    	<h1 class="card-title">Advance Salary</h1>
                    </div>
                    <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-end control-label col-form-label">Name</label>
                      <div class="col-sm-9">
                         <select name="employee_id" class="form-control">
                           <option value="">Select Employee</option>
                           @foreach($employees as $employee)
                           <option value="{{ $employee->id }}">
                             {{ $employee->name }}
                           </option>
                           @endforeach
                         </select>
                      </div>
                    </div>


                    <div class="form-group row">
                      <label for="email1" class="col-sm-3 text-end control-label col-form-label">  Amount
                      </label>
                      <div class="col-sm-9">
                        <input
                          type="text" name="amount"
                          class="form-control"
                          id="email1"
                          placeholder="Amount"
                        />
                      </div>
                    </div>
                   
                  </div>
                  <div class="border-top">
                    <div class="card-body">
                      <button type="submit" class="btn btn-primary">
                        Submit
                      </button>
                    </div>
                  </div>
                </form>
              </div>
 	</div>
 </div>
@endsection