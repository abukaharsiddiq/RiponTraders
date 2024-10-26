
@extends('back-end.master')

@section('admin-title')
Add Sale
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
              <form action="{{ route('sale.store') }}" method="POST">
                @csrf
                <div class="card-body">

                    <div class="add_item">
                    <div class="row">
                      
                       <div class="form-group col-lg-4">
                          <label> Group Name</label>
                          <select class="form-control select2" name="customer_group_id" style="width: 100%;" id="customer_group_id">
                              <option selected="selected">Select here</option>
                              @foreach($customer_groups as $group)
                              <option value="{{ $group->id }}">
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
                          <select class="form-control select2" name="customer_id" style="width: 100%;" id="customer_id">
                           
                          </select>
                           @error('customer_id')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>

                        <div class="form-group col-lg-2">
                            <label>Payment Type</label>
                            <select class="form-control" name="payment_type" style="width: 100%;">
                              <option selected="selected">Select here</option>
                              @foreach($banks as $bank)
                              <option value="{{ $bank->bank_slug }}">
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
                            <label>Invoice No</label>
                            <input type="text" name="order_no" class="form-control" value="{{ $VoucherNumber }}" readonly="">
                            @error('order_no')
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
                     <tr>
                       <td class="col-lg-2">
                         <select class="form-control product_group_id select2" name="product_group_id[]" id="product_group_id"><option selected="selected">Select here</option>@foreach( $product_groups as $show1)<option value="{{ $show1->id }}">{{ $show1->name }}</option>@endforeach</select>
                          @error('product_group_id')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                       </td>
                        <td class="col-lg-3">
                         <select class="form-control product_id select2" name="product_id[]" id="product_id"></select>
                       </td>

                        <td class="col-lg-2">
                         <input type="text" class="form-control unit_price" name="unit_price[]">
                       </td>

                        <td class="col-lg-2">
                         <input type="text" class="form-control quantity" name="quantity[]">
                       </td>


                        <td class="col-lg-2">
                         <input type="text" class="form-control unit_total" name="unit_total[]" value="0" readonly="">
                       </td>

                        <td class="col-lg-1">
                         <a class="btn btn-xs btn-danger" id="remove" style="background: red;">
                           <i class="fa fa-minus"></i>
                         </a>

                        <!--  <a class="btn btn-xs btn-danger" id="add_row">
                                   <i class="fa fa-plus"></i>
                         </a> -->
                        
                       </td>
                     </tr>
                   
                   </tbody>

                        <tfoot>
                          <tr>
                            <td colspan="3"></td>
                            <td>Sub Total:</td>
                            <td>
                              <input type="text" name="total_amount" class="form-control subtotal" value="0.00" readonly>
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
                              <input type="text" name="paid_amount" class="form-control paid_amount" value="0">
                            </td>
                          </tr>
                          <tr>
                            <td colspan="3"></td>
                            <td>Due Amount:</td>
                            <td>
                              <input type="text" name="due_amount" class="form-control due_amount" placeholder="0.00">
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
$(function(){

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
            ' <td class="col-lg-2"><select class="form-control product_group_id" name="product_group_id[]"><option selected="selected">Select here</option>@foreach( $product_groups as $show1)<option value="{{ $show1->id }}">{{ $show1->name }}</option>@endforeach</select></td>'+
            '<td class="col-lg-3"><select class="form-control product_id" name="product_id[]"></select></td>' +
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

    // Load products based on group selection
    $(document).on('change', '.product_group_id', function() {
        var $this = $(this);
        var product_group_id = $this.val();
        var $productIdSelect = $this.closest('tr').find('.product_id');
        $.ajax({
            url: '{{ route("get.products") }}',
            method: 'GET',
            dataType: 'json',
            data: { product_group_id: product_group_id },
            success: function(response) {
                $productIdSelect.empty();
                $productIdSelect.append('<option>Select Product</option>');
                response.forEach(function(res) {
                    $productIdSelect.append('<option value="' + res.id + '">' + res.name + '</option>');
                });
            }
        });
    });

    // Load customers based on group selection
    $(document).on('change','#customer_group_id',function(){
        var customer_group_id = $(this).val();
        $.ajax({
            url:'{{ route("get.customers") }}',
            method:'GET',
            dataType:'json',
            data:{customer_group_id:customer_group_id},
            success:function(response){
                $('#customer_id').empty();
                $('#customer_id').append('<option>Select Customer</option>');
                response.forEach(function(res){
                    $('#customer_id').append('<option value="'+res.id+'">'+res.name+'</option>');
                });
            }
        });
    });

});
</script>



@endpush