
@extends('back-end.master')

@section('admin-title')
Bank Calculation
@endsection

@push('admin-styles')
<style>
  
</style>
@endpush

@section('admin-content')
 <div class="row">
  <div class="col-md-12">
    <div class="card">
                <form class="form-horizontal" action="{{ route('bank-calculation.update') }}" method="POST">
                  @csrf
                  <div class="card-body">
                    <div class="row mb-4">
                      <h1 class="card-title">Bank Calculation</h1>
                    </div>


                       <div class="form-group row">
                           <label for="fname" class="col-sm-3 text-end control-label col-form-label">Bank Name</label>
                           <div class="col-sm-9">
                          <select class="form-control select2" name="bank_information_id" style="width: 100%;">
                              <option selected="selected">Select here</option>
                              @foreach($lists as $show)
                              <option value="{{ $show->id }}"  {{ $show->id==$info->bank_information_id?'selected':'' }}>
                                {{ $show->name }}
                              </option>
                              @endforeach
                          </select>
                           @error('bank_information_id')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        </div>

                    <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-end control-label col-form-label">Amount</label>
                      <div class="col-sm-9">
                        <input
                          type="text" name="amount"
                          class="form-control"
                          id="fname"
                          value="{{ $info->amount }}"
                        />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="lname" class="col-sm-3 text-end control-label col-form-label">Type</label>
                      <div class="col-sm-9">
                         <select name="type" class="form-control">
                           <option value="">Select Here</option>
                           <option value="widthdraw" {{ $info->type=="widthdraw"?'selected':'' }}>Widthdraw</option>
                           <option value="deposit" {{ $info->type=="deposit"?'selected':'' }}>Deposit</option>
                         </select>
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