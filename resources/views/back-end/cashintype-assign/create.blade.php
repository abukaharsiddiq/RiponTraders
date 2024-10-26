
@extends('back-end.master')

@section('admin-title')
Cash In Type Assign
@endsection

@push('admin-styles')
<style>
	
</style>
@endpush

@section('admin-content')
 <div class="row">
 	<div class="col-md-12">
 		<div class="card">
                <form class="form-horizontal" action="{{ route('cashintype-assign.store') }}" method="POST">
                	@csrf
                  <div class="card-body">
                    <div class="row mb-4">
                    	<h1 class="card-title">Cash In Type Assign</h1>
                    </div>


                       <div class="form-group row">
                           <label for="fname" class="col-sm-3 text-end control-label col-form-label">Cash In Type</label>
                           <div class="col-sm-9">
                          <select class="form-control select2" name="cash_in_type_id" style="width: 100%;">
                              <option selected="selected">Select here</option>
                              @foreach($cashInTypes as $info)
                              <option value="{{ $info->id }}">
                                {{ $info->name }}
                              </option>
                              @endforeach
                          </select>
                           @error('cash_in_type_id')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        </div>


                       <div class="form-group row">
                           <label for="fname" class="col-sm-3 text-end control-label col-form-label">Customer Group</label>
                           <div class="col-sm-9">
                          <select class="form-control select2" name="customer_group_id" style="width: 100%;">
                              <option selected="selected">Select here</option>
                              @foreach($customerGroups as $info1)
                              <option value="{{ $info1->id }}">
                                {{ $info1->name }}
                              </option>
                              @endforeach
                          </select>
                           @error('customer_group_id')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
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