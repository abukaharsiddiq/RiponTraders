
@extends('back-end.master')

@section('admin-title')
Update Sale
@endsection

@push('admin-styles')
<style>
   .table thead tr th{
    background: #f5f5f5;
   }
</style>
@endpush

@section('admin-content')
<div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
      <div class="card" style="padding:30px;">
             
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('purchase.update') }}" method="POST">
                @csrf
                <div class="card-body">

                    <div class="add_item">
                    <div class="row">

                      <input type="hidden" name="id" value="{{ $purchase->id }}">
                      
                       <div class="form-group col-lg-4">
                          <label> Customer Group</label>
                          <select class="form-control select2" name="customer_group_id" style="width: 100%;" id="customer_group_id">
                              <option selected="selected">Select here</option>
                              @foreach($customer_groups as $group)
                              <option value="{{ $group->id }}" {{ $group->id==$purchase->customer_group_id?'selected':'' }}>
                                {{ $group->name }}
                              </option>
                              @endforeach
                          </select>
                           @error('customer_group_id')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>

                          <div class="form-group col-lg-4">
                          <label> Customer Name</label>
                          <select class="form-control select2" name="customer_id" id="customer_id" style="width: 100%;">
                           
                          </select>
                           @error('customer_id')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>

                        <div class="form-group col-lg-2">
                            <label>Payment Type</label>
                            <select class="form-control select2" name="payment_type" style="width: 100%;">
                              <option selected="selected">Select here</option>
                              @foreach($banks as $bank)
                              <option value="{{ $bank->bank_slug }}" {{ $bank->bank_slug==$purchase->payment->payment_type?'selected':'' }}>
                                {{ $bank->bank_name }}
                              </option>
                              @endforeach
                          </select>
                           @error('payment_type')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                           @enderror
                        </div>

                        <div class="form-group col-lg-2">
                            <label>Purchase No</label>
                            <input type="text" name="purchase_no" class="form-control" value="{{ $purchase->purchase_no }}" readonly="">
                            @error('purchase_no')
                            <span class="text-danger">{{ $message }}</span>
                           @enderror
                        </div>
                  </div>
                  </div>

                  <div class="row">
                     <table class="table table-bordered">
                       <thead>
                         <tr>
                           <th>Group</th>
                           <th>Product</th>
                           <th>Unit Price</th>
                           <th>Quantity</th>
                           <th>Unit Total</th>
                           <th>Action</th>
                         </tr>
                       </thead>

                      <tbody>
                     @foreach($purchase->purchase_details as $details)
                        <tr>
                          <td class="col-lg-2">
                            <select class="form-control product_group_id" name="product_group_id[]">
                              <option selected="selected">Select here</option>
                              @foreach($product_groups as $productGroup)
                              <option value="{{ $productGroup->id }}" {{ $productGroup->id == $details->product_group_id ? 'selected' : '' }}>{{ $productGroup->name }}</option>
                              @endforeach
                            </select>
                          </td>

                             <td class="col-lg-3">
                            <select class="form-control product_id" name="product_id[]">
                              <option selected="selected">Select here</option>
                              @foreach($products as $show)
                              <option value="{{ $show->id }}" {{ $show->id == $details->product_id ? 'selected' : '' }}>{{ $show->name }}</option>
                              @endforeach
                            </select>
                          </td>

                          <td class="col-lg-2">
                            <input type="text" class="form-control unit_price" name="unit_price[]" value="{{ $details->unit_price }}">
                          </td>

                          <td class="col-lg-2">
                            <input type="text" class="form-control quantity" name="quantity[]" value="{{ $details->quantity }}">
                          </td>

                          <td class="col-lg-2">
                            <input type="text" class="form-control unit_total" name="unit_total[]" value="{{ $details->unit_price * $details->quantity }}" readonly="">
                          </td>

                          <td class="col-lg-1">
                            <a class="btn btn-xs btn-danger" id="remove" style="background: red;">
                              <i class="fa fa-minus"></i>
                            </a>
                          </td>
                        </tr>
                      @endforeach

                   
                   </tbody>

                        <tfoot>
                          <tr>
                            <td colspan="3"></td>
                            <td>Sub Total:</td>
                            <td>
                              <input type="text" name="total_amount" class="form-control subtotal" value="{{ $purchase->total_amount }}" readonly>
                            </td>
                            <td>
                              <a class="btn btn-xs btn-primary" id="add_row">
                                  <i class="fa fa-plus"></i>
                              </a>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="3"></td>
                            <td>Paid Amount:</td>
                            <td>
                              <input type="text" name="paid_amount" class="form-control paid_amount" value="{{ $purchase->payment->paid_amount }}">
                            </td>
                          </tr>
                          <tr>
                            <td colspan="3"></td>
                            <td>Due Amount:</td>
                            <td>
                              <input type="text" name="due_amount" class="form-control due_amount" value="{{ $purchase->payment->due_amount }}">
                            </td>

                          </tr>
                        </tfoot>

                     </table>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-center">Submit</button>
                </div>
              </form>
            
      </div>

       </div>
    </div>
</div>
@endsection

@push('admin-scripts')
<script>
$(function() {
    // Function to calculate subtotal amount
    function calculateSubtotal() {
        var sum = 0;
        $('.unit_total').each(function() {
            var value = parseFloat($(this).val()) || 0;
            sum += value;
        });
        $('.subtotal').val(sum); // Ensure two decimal places
        calculateDueAmount(); // Recalculate due amount whenever subtotal is updated
    }

    // Function to calculate due amount
    function calculateDueAmount() {
        var SubTotal = parseFloat($('.subtotal').val()) || 0;
        var PaidAmount = parseFloat($('.paid_amount').val()) || 0;
        var DueAmount = SubTotal - PaidAmount;
        $('.due_amount').val(DueAmount); // Ensure two decimal places
    }

    // Trigger due amount calculation when paid amount changes
    $(document).on('keyup', '.paid_amount', function() {
        calculateDueAmount();
    });

    // Function to calculate unit total based on quantity and unit price
    $(document).on('keyup', '.quantity, .unit_price', function() {
        var tr = $(this).closest('tr');
        var UnitPrice = parseFloat(tr.find('input.unit_price').val()) || 0;
        var Quantity = parseFloat(tr.find('input.quantity').val()) || 0;
        var UnitTotal = UnitPrice * Quantity;
        tr.find('input.unit_total').val(UnitTotal); // Ensure two decimal places
        calculateSubtotal(); // Update subtotal when unit total changes
    });

    // Add new row for products
    $('#add_row').on('click', function() {
        addRow();
    });

    // Function to add new row
    function addRow() {
        var tr = '<tr>' +
            '<td class="col-lg-2"><select class="form-control product_group_id" name="product_group_id[]"><option selected="selected">Select here</option>@foreach($product_groups as $productGroup)<option value="{{ $productGroup->id }}">{{ $productGroup->name }}</option>@endforeach</select></td>' +
            '<td class="col-lg-3"><select class="form-control product_id" name="product_id[]"><option selected="selected">Select here</option>@foreach($products as $show)<option value="{{ $show->id }}">{{ $show->name }}</option>@endforeach</select></td>' +
            '<td class="col-lg-2"><input type="text" class="form-control unit_price" name="unit_price[]"></td>' +
            '<td class="col-lg-2"><input type="text" class="form-control quantity" name="quantity[]"></td>' +
            '<td class="col-lg-2"><input type="text" class="form-control unit_total" name="unit_total[]" value="0.00" readonly></td>' +
            '<td class="col-lg-1"><a class="btn btn-xs btn-danger" id="remove" style="background: red;"><i class="fa fa-minus"></i></a></td>' +
            '</tr>';
        $('tbody').append(tr);
    }

    // Remove row
    $(document).on('click', '#remove', function() {
        var last = $('tbody tr').length;
        if (last == 1) {
            alert('Field cannot be deleted!');
        } else {
            $(this).closest('tr').remove();
            calculateSubtotal(); // Recalculate subtotal and due amount when a row is removed
        }
    });

    // Load products based on selected product group
    $(document).on('change', '.product_group_id', function() {
        var $this = $(this);
        var product_group_id = $this.val();
        var $productSelect = $this.closest('tr').find('.product_id');

        $.ajax({
            url: '{{ route("get.products") }}',
            method: 'GET',
            dataType: 'json',
            data: { product_group_id: product_group_id },
            success: function(response) {
                var selectedProductId = $productSelect.val(); // Preserve the selected product ID

                $productSelect.empty();
                $productSelect.append('<option>Select Product</option>');

                response.forEach(function(res) {
                    var selected = (res.id == selectedProductId) ? 'selected' : '';
                    $productSelect.append('<option value="'+res.id+'" '+selected+'>'+res.name+'</option>');
                });
            }
        });
    });

    // Load customer based on selected customer group
    $(document).on('change', '#customer_group_id', function() {
        var customer_group_id = $(this).val();
        $.ajax({
            url: '{{ route("get.customers") }}',
            method: 'GET',
            dataType: 'json',
            data: { customer_group_id: customer_group_id },
            success: function(response) {
                var selectedCustomerId = "{{ $purchase->customer_id }}"; // Previous selected customer ID
                $('#customer_id').empty();
                $('#customer_id').append('<option>Select Customer</option>');
                response.forEach(function(res) {
                    var selected = (res.id == selectedCustomerId) ? 'selected' : '';
                    $('#customer_id').append('<option value="'+res.id+'" '+selected+'>'+res.name+'</option>');
                });
            }
        });
    });

    // Trigger change event on page load if group is already selected
    if ($('#customer_group_id').val()) {
        $('#customer_group_id').trigger('change');
    }

    // Trigger change event on page load if product group is already selected
    $('.product_group_id').each(function() {
        if ($(this).val()) {
            $(this).trigger('change');
        }
    });
});
</script>
@endpush
