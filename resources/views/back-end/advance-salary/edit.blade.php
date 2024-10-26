
@extends('back-end.master')

@section('admin-title')
Update Advance Salary
@endsection

@push('admin-styles')
<style>
  
</style>
@endpush

@section('admin-content')
 <div class="row">
  <div class="col-md-12">
    <div class="card">
                <form class="form-horizontal" action="{{ route('advance-salary.update') }}" method="POST">
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
                           <option value="{{ $employee->id }}"  {{ $employee->id==$info->employee_id?'selected':'' }}>
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
                          id="email1" value="{{ $info->amount }}"
                          placeholder="Amount"
                        />
                      </div>
                    </div>

                    <input type="hidden" name="id" value="{{ $info->id }}">
                   
                  </div>
                  <div class="border-top">
                    <div class="card-body">
                      <button type="submit" class="btn btn-primary">
                        Update
                      </button>
                    </div>
                  </div>
                </form>
              </div>
  </div>
 </div>
@endsection