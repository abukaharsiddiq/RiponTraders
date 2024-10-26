@extends('back-end.master')

@section('admin-title')
Bank Details
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
          <div class="col-md-6">
            <div class="row mb-4">
                      <h1 class="card-title">Bank Deposit</h1>
                    </div>
                  <div class="table-responsive">
                    <table
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Date</th>
                          <th>Month</th>
                          <th>Amount</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        @php
                        $i=1;
                        $sum=0;
                        @endphp
                        @foreach($bank_deposits as $info)
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ $info->date }}</td>
                          <td>{{ $info->cal_month }}</td>
                          <td>{{ $info->amount }}</td>
                          @php
                           $sum+=$info->amount;
                          @endphp
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th></th>
                          <th></th>
                          <th>Total: </th>
                          <th>{{ $sum }}</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
          </div>
          <div class="col-md-6">
            <div class="row mb-4">
                      <h1 class="card-title">Bank Widthdraw</h1>
                    </div>
                  <div class="table-responsive">
                    <table
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Date</th>
                          <th>Month</th>
                          <th>Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                         $i=1;
                         $sum1=0;
                        @endphp
                        @foreach($bank_widthdraws as $info1)
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ $info1->date }}</td>
                          <td>{{ $info1->cal_month }}</td>
                          <td>{{ $info1->amount }}</td>
                          @php
                           $sum1+=$info1->amount;
                          @endphp
                        </tr>
                        @endforeach
                      </tbody>
                       <tfoot>
                        <tr>
                          <th></th>
                          <th></th>
                          <th>Total: </th>
                          <th>{{ $sum1 }}</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
          </div>
        </div>
   </div>
</div>
@endsection

@push('admin-scripts')

@endpush