
@extends('back-end.master')

@section('admin-title')
Add CashIn
@endsection

@push('admin-styles')
<style>
	
</style>
@endpush

@section('admin-content')
 <div class="row">
 	<div class="col-md-12">
 		<div class="card">
                <form class="form-horizontal" action="{{ route('cashin.store') }}" method="POST">
                	@csrf
                  <div class="card-body">
                    <div class="row mb-4">
                    	<h1 class="card-title">Create CashIn</h1>
                    </div>

                      <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-end control-label col-form-label">Payment Type <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="payment_type" style="width: 100%;" id="payment_type">
                                <option value="">Select here</option>
                                <option value="cash">Cash</option>
                                <option value="bank">Bank</option>
                            </select>
                            @error('payment_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row" id="bank_info_group" style="display: none;">
                        <label for="fname" class="col-sm-3 text-end control-label col-form-label">Bank Name</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="bank_information_id" style="width: 100%;" id="bank_information_id">
                                <option value="0">Select here</option>
                                @foreach($banks as $bank)
                                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                @endforeach
                            </select>
                            @error('bank_information_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                          <div class="form-group row">
                           <label for="fname" class="col-sm-3 text-end control-label col-form-label">Cash In Type <span class="text-danger">*</span></label>
                           <div class="col-sm-9">
                          <select class="form-control select2" name="cash_in_type_id" style="width: 100%;" id="cash_in_type_id">
                              <option selected="selected" value="0">Select here</option>
                              @foreach($cashInTypes as $data)
                              <option value="{{ $data->id }}">{{ $data->name }}</option>
                              @endforeach
                          </select>
                           @error('customer_group_id')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        </div>

                        <div class="form-group row">
                           <label for="fname" class="col-sm-3 text-end control-label col-form-label">Customer Group</label>
                           <div class="col-sm-9">
                          <select class="form-control select2" name="customer_group_id" style="width: 100%;" id="customer_group_id"></select>
                           @error('customer_group_id')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-end control-label col-form-label">Customer Name</label>
                            <div class="col-sm-9">
                              <select class="form-control select2" name="customer_id" style="width: 100%;" id="customer_id">
                              </select>
                               @error('customer_id')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-end control-label col-form-label">Customer invoices</label>
                            <div class="col-sm-9">
                              <select class="form-control select2" name="order_no" style="width: 100%;" id="invoices">
                              </select>
                            </div>
                        </div>

                    <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-end control-label col-form-label">Reason <span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        <input
                          type="text" name="reason"
                          class="form-control"
                          id="fname"
                          placeholder="Reason"
                        />
                      </div>
                    </div>

                     <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-end control-label col-form-label">Amount <span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        <input
                          type="text" name="amount"
                          class="form-control"
                          id="fname"
                          placeholder="Amount"
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

@push('admin-scripts')
 <script>

    $(document).on('change','#cash_in_type_id',function(){
        var cash_in_type_id = $(this).val();
        $.ajax({
            url:'{{ route("get.customer.group") }}',
            method:'GET',
            dataType:'json',
            data:{cash_in_type_id:cash_in_type_id},
           success:function(response){
                let options = '<option value="">Select Group</option>';
                response.forEach(function(res){
                    options += '<option value="'+res.customer_group.id+'">'+res.customer_group.name+'</option>';
                });
                $('#customer_group_id').html(options);
            }
        });
    });

     $(document).on('change','#customer_group_id',function(){
        var customer_group_id = $(this).val();
        $.ajax({
            url:'{{ route("get.customers") }}',
            method:'GET',
            dataType:'json',
            data:{customer_group_id:customer_group_id},
           success:function(response){
                let options = '<option value="">Select Customer</option>';
                response.forEach(function(res){
                    options += '<option value="'+res.id+'">'+res.name+'</option>';
                });
                $('#customer_id').html(options);
            }
        });
    });

    $(document).on('change','#customer_id',function(){
        var customer_id = $(this).val();
        $.ajax({
            url:'{{ route("get.invoices") }}',
            method:'GET',
            dataType:'json',
            data:{customer_id:customer_id},
           success:function(response){
                let options = '<option value="">Select invoices</option>';
                response.forEach(function(res){
                    options += '<option value="'+res.order_no+'">'+res.order_no+'</option>';
                });
                $('#invoices').html(options);
            }
        });
    });

 </script>

 <script>
   $(document).ready(function() {
    $('#payment_type').on('change', function() {
        if ($(this).val() === 'bank') {
            $('#bank_info_group').show();
        } else {
            $('#bank_info_group').hide();
        }
    });
});
 </script>
@endpush