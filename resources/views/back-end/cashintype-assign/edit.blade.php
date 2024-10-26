
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
                <form class="form-horizontal" action="{{ route('cashintype-assign.update') }}" method="POST">
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
                              @foreach($cashInTypes as $show)
                              <option value="{{ $show->id }}" {{ $show->id==$info->cash_in_type_id?'selected':'' }} >
                                {{ $show->name }}
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
                              @foreach($customerGroups as $show1)
                              <option value="{{ $show1->id }}" {{ $show1->id==$info->customer_group_id?'selected':'' }} >
                                {{ $show1->name }}
                              </option>
                              @endforeach
                          </select>
                           @error('customer_group_id')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        </div>

                        <input type="hidden" name="id" value="{{ $info->id }}">
                   
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