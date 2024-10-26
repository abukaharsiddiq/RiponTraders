
@extends('back-end.master')

@section('admin-title')
Update CashIn
@endsection

@push('admin-styles')
<style>
  
</style>
@endpush

@section('admin-content')
 <div class="row">
  <div class="col-md-12">
    <div class="card">
                <form class="form-horizontal" action="{{ route('cashin.update') }}" method="POST">
                  @csrf
                  <div class="card-body">
                    <div class="row mb-4">
                      <h1 class="card-title">Update CashIn</h1>
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
                           <label for="fname" class="col-sm-3 text-end control-label col-form-label">Cash In Type <span class="text-danger">*</span></label>
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
                           <label for="fname" class="col-sm-3 text-end control-label col-form-label">Customer Group</label>
                           <div class="col-sm-9">
                          <select class="form-control select2" name="customer_group_id" style="width: 100%;" id="customer_group_id"></select>
                           @error('customer_group_id')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-end control-label col-form-label">Customer</label>
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
   function loadCustomerGroups(cash_in_type_id, selectedCustomerGroup = null, selectedCustomer = null, selectedInvoice = null) {
      if (cash_in_type_id) {
          $.ajax({
              url: '{{ route("get.customer.group") }}',
              method: 'GET',
              dataType: 'json',
              data: { cash_in_type_id: cash_in_type_id },
              success: function(response) {
                  let options = '<option value="">Select Group</option>';
                  response.forEach(function(res) {
                      options += '<option value="'+res.customer_group.id+'" '+ (res.customer_group.id == selectedCustomerGroup ? 'selected' : '') +'>'+res.customer_group.name+'</option>';
                  });
                  $('#customer_group_id').html(options);

                  if (selectedCustomerGroup) {
                      loadCustomers(selectedCustomerGroup, selectedCustomer,selectedInvoice);
                  }
              }
          });
      } else {
          $('#customer_group_id').empty().append('<option>Select Group</option>');
          $('#customer_id').empty().append('<option>Select Customer</option>');
      }
   }

   function loadCustomers(customer_group_id, selectedCustomer = null, selectedInvoice = null) {
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

                   if (selectedCustomer) {
                       loadInvoices(selectedCustomer, selectedInvoice);
                   }

                   $('#customer_id').off('change').on('change', function() {
                       let customer_id = $(this).val();
                       if (customer_id) {
                           loadInvoices(customer_id, null);
                       } else {
                           $('#invoices').empty().append('<option>Select Invoices</option>');
                       }
                   });
               }
           });
       } else {
           $('#customer_id').empty().append('<option>Select Customer</option>');
       }
   }

   function loadInvoices(customer_id, selectedInvoice = null) {
       if (customer_id) {
           $.ajax({
               url: '{{ route("get.invoices") }}',
               method: 'GET',
               dataType: 'json',
               data: { customer_id: customer_id },
               success: function(response) {
                   let options = '<option value="">Select Invoices</option>';
                   response.forEach(function(res) {
                       options += '<option value="'+res.order_no+'" '+ (res.order_no == selectedInvoice ? 'selected' : '') +'>'+res.order_no+'</option>';
                   });
                   $('#invoices').html(options);

                   // Check if the selectedInvoice is properly selected
                   if (selectedInvoice) {
                       $('#invoices').val(selectedInvoice); // Ensure the selected invoice remains selected
                   }
               }
           });
       } else {
           $('#invoices').empty().append('<option>Select Invoices</option>');
       }
   }

   // On Cash In Type change
   $('#cash_in_type_id').on('change', function() {
       var cash_in_type_id = $(this).val();
       loadCustomerGroups(cash_in_type_id);
   });

   // On Customer Group change
   $('#customer_group_id').on('change', function(event) {
       var customer_group_id = $(this).val();
       loadCustomers(customer_group_id, null);
   });

   // Load initial data if Cash In Type exists
   var initialCashInTypeId = $('#cash_in_type_id').val();
   var selectedCustomerGroup = '{{ $selectedCustomerGroup }}';
   var selectedCustomer = '{{ $selectedCustomer }}';
   var selectedInvoice = '{{ $selectedInvoice }}';

   if (initialCashInTypeId) {
       loadCustomerGroups(initialCashInTypeId, selectedCustomerGroup, selectedCustomer, selectedInvoice);
   }

   // Payment Type change handler to show/hide bank info
   if ($('#payment_type').val() === 'bank') {
       $('#bank_info_group').show();
   } else {
       $('#bank_info_group').hide();
   }

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