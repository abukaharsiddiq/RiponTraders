
@extends('back-end.master')

@section('admin-title')
Bank Information
@endsection

@push('admin-styles')
<style>
	
</style>
@endpush

@section('admin-content')
 <div class="row">
 	<div class="col-md-12">
 		<div class="card">
                <form class="form-horizontal" action="{{ route('bank.store') }}" method="POST">
                	@csrf
                  <div class="card-body">
                    <div class="row mb-4">
                    	<h1 class="card-title">Create Bank</h1>
                    </div>

                    <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-end control-label col-form-label">Name</label>
                      <div class="col-sm-9">
                        <input
                          type="text" name="name"
                          class="form-control"
                          id="fname"
                          placeholder="Name"
                        />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="lname" class="col-sm-3 text-end control-label col-form-label">Account No</label>
                      <div class="col-sm-9">
                        <input
                          type="text" name="account_no"
                          class="form-control"
                          id="lname"
                          placeholder="Account No"
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