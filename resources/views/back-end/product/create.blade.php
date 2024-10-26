
@extends('back-end.master')

@section('admin-title')
Add Product
@endsection

@push('admin-styles')
<style>
	
</style>
@endpush

@section('admin-content')
 <div class="row">
 	<div class="col-md-12">
 		<div class="card">
                <form class="form-horizontal" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                	@csrf
                  <div class="card-body">
                    <div class="row mb-4">
                    	<h1 class="card-title">Create Product</h1>
                    </div>

                     <div class="form-group row">
                           <label for="fname" class="col-sm-3 text-end control-label col-form-label">Group</label>
                           <div class="col-sm-9">
                          <select class="form-control select2" name="product_group_id" style="width: 100%;">
                              <option selected="selected">Select here</option>
                              @foreach($groups as $group)
                              <option value="{{ $group->id }}">
                                {{ $group->name }}
                              </option>
                              @endforeach
                          </select>
                           @error('product_group_id')
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
                          id="fname"
                          placeholder="Name"
                        />
                      </div>
                    </div>

                     <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-end control-label col-form-label">Barcode</label>
                      <div class="col-sm-9">
                        <input
                          type="text" name="barcode"
                          class="form-control"
                          id="fname"
                          placeholder="Barcode"
                        />
                      </div>
                    </div>

                     <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-end control-label col-form-label">Image</label>
                      <div class="col-sm-9">
                        <input
                          type="file" name="image"
                          class="form-control"
                          id="fname" 
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