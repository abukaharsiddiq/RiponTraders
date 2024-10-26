@extends('back-end.master')

@section('admin-title')
Product History
@endsection

@push('admin-styles')
<style>
	a.btn-primay{
		content:'';
		position: absolute;
		right: 0;
	}
  h1.card-title{
    font-size: 22px;
  }
</style>
@endpush

@section('admin-content')

<div class="card">
   <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <div class="row mb-4">
                      <h1 class="card-title">Product Sale</h1>
                    </div>
                  <div class="table-responsive">
                    <table id="sales_table" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Date</th>
                          <th>Order No</th>
                          <th>Customer</th>
                          <th>Quantity</th>
                          <th>Unit Price</th>
                          <th>Unit Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                        $i=1;
                        @endphp
                        @foreach($sale_details as $info)
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ $info->date }}</td>
                          <td>{{ $info->order_no }}</td>
                          <td>{{ $info->customer->name }}</td>
                          <td>{{ $info->quantity }}</td>
                          <td>{{ $info->unit_price }}</td>
                          <td>{{ $info->quantity*$info->unit_price }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
          </div>
        </div>
   </div>
</div>

<div class="card">
   <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <div class="row mb-4">
                      <h1 class="card-title">Product Purchase</h1>
                    </div>
                  <div class="table-responsive">
                    <table id="purchase_table" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Date</th>
                          <th>Order No</th>
                          <th>Supplier</th>
                          <th>Quantity</th>
                          <th>Unit Price</th>
                          <th>Unit Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                         $i=1;
                        @endphp
                        
                        @foreach($purchase_details as $info1)
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ $info1->date }}</td>
                          <td>{{ $info1->purchase_no }}</td>
                          <td>{{ $info1->customer->name ?? "" }}</td>
                          <td>{{ $info1->quantity }}</td>
                          <td>{{ $info1->unit_price }}</td>
                          <td>{{ $info1->quantity * $info1->unit_price }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
          </div>
        </div>
   </div>
</div>

@endsection

@push('admin-scripts')
<script>
  $('#sales_table').DataTable();
$('#purchase_table').DataTable();
</script>
@endpush