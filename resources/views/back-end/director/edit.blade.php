
@extends('back-end.master')

@section('admin-title')
Update Customer
@endsection

@push('admin-styles')
<style>
	
</style>
@endpush

@section('admin-content')
 <div class="row">
 	<div class="col-md-12">
 		<div class="card">
                <form class="form-horizontal" action="{{ route('director.update') }}" method="POST">
                	@csrf
                  <div class="card-body">
                    <div class="row mb-4">
                    	<h1 class="card-title">Update Director</h1>
                    </div>
                    
                    <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-end control-label col-form-label">Name</label>
                      <div class="col-sm-9">
                        <input
                          type="text" name="name"
                          class="form-control"
                          id="fname" value="{{ $info->name }}"
                          placeholder="First Name Here"
                        />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Phone No</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text" name="phone"
                          class="form-control"
                          id="lname" value="{{ $info->phone }}"
                          placeholder="Phone No"
                        />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label
                        for="email1"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Address</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text" name="address"
                          class="form-control"
                          id="email1" value="{{ $info->address }}"
                          placeholder="Address"
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