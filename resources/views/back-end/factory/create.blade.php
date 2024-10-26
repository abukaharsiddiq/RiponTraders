
@extends('back-end.master')

@section('admin-title')
Factory
@endsection

@push('admin-styles')
<style>
	
</style>
@endpush

@section('admin-content')
 <div class="row">
 	<div class="col-md-12">
 		<div class="card">
                <form class="form-horizontal" action="{{ route('factory.store') }}" method="POST">
                	@csrf
                  <div class="card-body">
                    <div class="row mb-4">
                    	<h1 class="card-title">Create Factory</h1>
                    </div>
                    <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-end control-label col-form-label">Name</label>
                      <div class="col-sm-9">
                         <select name="factory_group_id" class="form-control">
                           <option value="">Select Group</option>
                              @foreach($groups as $group)
                           <option value="{{ $group->id }}">
                            {{ $group->name }}
                           </option>
                           @endforeach
                         </select>
                      </div>
                    </div>


                    <div class="form-group row">
                      <label for="reason" class="col-sm-3 text-end control-label col-form-label">  Reason
                      </label>
                      <div class="col-sm-9">
                        <input
                          type="text" name="reason"
                          class="form-control"
                          id="reason"
                          placeholder="Reason"
                        />
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