
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
                <form class="form-horizontal" action="{{ route('customer.update') }}" method="POST">
                	@csrf

                  <div class="card-header">
                     <h1 class="card-title">Update Customer</h1>
                    </div>

                  <div class="card-body">

                      <div class="form-group row">
                           <label for="fname" class="col-sm-3 text-end control-label col-form-label">Group Name</label>
                           <div class="col-sm-9">
                          <select class="form-control select2" name="seller_buyer" style="width: 100%;">
                              <option value="0">Select here</option>
                              <option value="seller" {{ $info->seller_buyer=="seller"?'selected':'' }}>Seller</option>
                              <option value="buyer" {{ $info->seller_buyer=="buyer"?'selected':'' }}>Buyer</option>
                              <option value="supplier" {{ $info->seller_buyer=="supplier"?'selected':'' }}>Supplier</option>
                             
                          </select>
                           @error('seller_buyer')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        </div>


                         <div class="form-group row">
                           <label for="fname" class="col-sm-3 text-end control-label col-form-label">Location Name</label>
                           <div class="col-sm-9">
                          <select class="form-control select2" name="customer_group_id" style="width: 100%;">
                              <option selected="selected">Select here</option>
                              @foreach($groups as $group)
                              <option value="{{ $group->id }}"  {{ $group->id==$info->customer_group_id?'selected':'' }}>
                                {{ $group->name }}
                              </option>
                              @endforeach
                          </select>
                           @error('customer_group_id')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
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