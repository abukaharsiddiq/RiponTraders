
@extends('back-end.master')

@section('admin-title')
Update CashOut
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
                      <h1 class="card-title">Update CashOut</h1>
                    </div>

                      <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-end control-label col-form-label">Payment Type <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="payment_type" style="width: 100%;" id="payment_type">
                                <option value="">Select here</option>
                                <option value="cash" {{ $info->payment_type=="cash"?'selected':'' }}>Cash</option>
                                <option value="bank" {{ $info->payment_type=="bank"?'selected':'' }}>Bank</option>
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
                                <option value="{{ $bank->id }}" {{ $bank->id==$info->bank_information_id?'selected':'' }}>
                                  {{ $bank->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('bank_information_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                           <label for="fname" class="col-sm-3 text-end control-label col-form-label">Cash In Type</label>
                           <div class="col-sm-9">
                          <select class="form-control select2" name="cash_in_type_id" style="width: 100%;" id="cash_in_type_id">
                              <option>Select here</option>
                              @foreach($cashInTypes as $data)
                                  <option value="{{ $data->id }}" {{ $data->id == $selectedCashInType ? 'selected' : '' }}>{{ $data->name }}</option>
                              @endforeach
                          </select>
                           @error('cash_in_type_id')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        </div>

                        <div class="form-group row">
                           <label for="fname" class="col-sm-3 text-end control-label col-form-label">Customer Group(optional)</label>
                           <div class="col-sm-9">
                          <select class="form-control select2" name="customer_group_id" style="width: 100%;" id="customer_group_id"></select>
                           @error('customer_group_id')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-end control-label col-form-label">Customer(optional)</label>
                            <div class="col-sm-9">
                              <select class="form-control select2" name="customer_id" style="width: 100%;" id="customer_id">
                              </select>
                               @error('customer_id')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                        </div>

                    <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-end control-label col-form-label">Reason</label>
                      <div class="col-sm-9">
                        <input
                          type="text" name="reason"
                          class="form-control"
                          id="fname" value="{{ $info->reason }}"
                          placeholder="Reason"
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

@push('admin-scripts')
 <script>

$(document).ready(function() {
   function loadCustomerGroups(cash_in_type_id, selectedCustomerGroup = null, selectedCustomer = null) {
      // alert(cash_in_type_id);
    if (cash_in_type_id) {
        $.ajax({
            url: '{{ route("get.customer.group") }}',
            method: 'GET',
            dataType: 'json',
            data: { cash_in_type_id: cash_in_type_id },
            success: function(response) {
              console.log(response); 
               let options = '<option value="">Select Group</option>';
                response.forEach(function(res) {
                    options += '<option value="'+res.customer_group.id+'" '+ (res.customer_group.id == selectedCustomerGroup ? 'selected' : '') +'>'+res.customer_group.name+'</option>';
                });
                $('#customer_group_id').html(options);

                if (selectedCustomerGroup) {
                    loadCustomers(selectedCustomerGroup, selectedCustomer);
                }
            }
        });
    } else {
        $('#customer_group_id').empty().append('<option>Select Group</option>');
        $('#customer_id').empty().append('<option>Select Customer</option>');
    }
}


function loadCustomers(customer_group_id, selectedCustomer = null) {
    if (customer_group_id) {
        $.ajax({
            url: '{{ route("get.customers") }}',
            method: 'GET',
            dataType: 'json',
            data: { customer_group_id: customer_group_id },
            success: function(response) {
                let options = '<option value="">Select Customer</option>';
                response.forEach(function(res) {
                    options += '<option value="'+res.id+'" '+ (res.id == selectedCustomer ? 'selected' : '') +'>'+res.name+'</option>';
                });
                $('#customer_id').html(options);
            }
        });
    } else {
        $('#customer_id').empty().append('<option>Select Customer</option>');
    }
}




    $('#cash_in_type_id').on('change', function() {
        var cash_in_type_id = $(this).val();
        loadCustomerGroups(cash_in_type_id);
    });

    $('#customer_group_id').on('change', function(event, selectedCustomer = null) {
        var customer_group_id = $(this).val();
        loadCustomers(customer_group_id, selectedCustomer);
    });

      var initialCashInTypeId = $('#cash_in_type_id').val();
      var selectedCustomerGroup = '{{ $selectedCustomerGroup }}';
      var selectedCustomer = '{{ $selectedCustomer }}';

      if (initialCashInTypeId) {
          loadCustomerGroups(initialCashInTypeId, selectedCustomerGroup, selectedCustomer);
      }


    if ($('#payment_type').val() === 'bank') {
        $('#bank_info_group').show();
    } else {
        $('#bank_info_group').hide();
    }

    // Payment Type পরিবর্তন হলে Bank Information দেখানো বা লুকানো
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