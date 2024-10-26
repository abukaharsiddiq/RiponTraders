
@extends('back-end.master')

@section('admin-title')
Customer Group
@endsection

@push('admin-styles')
<style>
	
</style>
@endpush

@section('admin-content')
 <div class="row">
 	<div class="col-md-12">
 		<div class="card">
                <form class="form-horizontal" action="{{ route('customer-group.update') }}" method="POST">
                	@csrf

                  <div class="card-header">
                    <h1 class="card-title">Update Group</h1>
                  </div>
                  
                  <div class="card-body">

                    <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-end control-label col-form-label">Name</label>
                      <div class="col-sm-9">
                        <input
                          type="text" name="name"
                          class="form-control"
                          id="fname" value="{{ $info->name }}"
                          placeholder="Name"
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