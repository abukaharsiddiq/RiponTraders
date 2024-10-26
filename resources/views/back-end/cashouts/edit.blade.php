
@extends('back-end.master')

@section('admin-title')
Update Cash Out
@endsection

@push('admin-styles')
<style>
  
</style>
@endpush

@section('admin-content')
 <div class="row">
  <div class="col-md-12">
    <div class="card">
                <form class="form-horizontal" action="{{ route('cashout.update') }}" method="POST">
                  @csrf
                  <div class="card-body">
                    <div class="row mb-4">
                      <h1 class="card-title">Update Cash Out</h1>
                    </div>

                    <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-end control-label col-form-label">Title</label>
                      <div class="col-sm-9">
                        <input
                          type="text" name="title"
                          class="form-control"
                          id="fname" value="{{ $info->title }}"
                          placeholder="Title"
                        />
                      </div>
                    </div>

                     <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-end control-label col-form-label">Amount</label>
                      <div class="col-sm-9">
                        <input
                          type="text" name="amount"
                          class="form-control"
                          id="fname" value="{{ $info->amount }}"
                          placeholder="Amount"
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