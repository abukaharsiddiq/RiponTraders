
@extends('back-end.master')

@section('admin-title')
Director Payment
@endsection

@push('admin-styles')
<style>
  
</style>
@endpush

@section('admin-content')
 <div class="row">
  <div class="col-md-12">
    <div class="card">
                <form class="form-horizontal" action="{{ route('director-payment.update') }}" method="POST">
                  @csrf
                  <div class="card-body">
                    <div class="row mb-4">
                      <h1 class="card-title">Director Payment</h1>
                    </div>


                       <div class="form-group row">
                           <label for="fname" class="col-sm-3 text-end control-label col-form-label">Director</label>
                           <div class="col-sm-9">
                          <select class="form-control select2" name="director_id" style="width: 100%;">
                              <option selected="selected">Select here</option>
                              @foreach($lists as $show)
                              <option value="{{ $show->id }}" {{ $show->id==$info->director_id?'selected':'' }}>
                                {{ $show->name }}
                              </option>
                              @endforeach
                          </select>
                           @error('director_id')
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