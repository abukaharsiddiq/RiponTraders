
@extends('back-end.master')

@section('admin-title')
Product Group 
@endsection

@push('admin-styles')
<style>
	
</style>
@endpush

@section('admin-content')
 <div class="row">
 	<div class="col-md-12">
 		<div class="card">
                <form class="form-horizontal" action="{{ route('product-group.store') }}" method="POST">
                	@csrf
                  <div class="card-body">
                    <div class="row mb-4">
                    	<h1 class="card-title">Create Group</h1>
                    </div>
                    <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-end control-label col-form-label">Group Name</label>
                      <div class="col-sm-9">
                        <input
                          type="text" name="name"
                          class="form-control"
                          id="fname"
                          placeholder="Group Name"
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