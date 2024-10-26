@extends('back-end.master')

@section('admin-title')
 Dashboard || Ripon Traders
@endsection

@push('admin-styles')
 <style>
 	  .button-area a{
      text-align: center;
    }
    .btn.btn-md.d-btn {
    border: 1px solid rgba(0,0,0,.5);
    border-radius: 0;
}
 </style>
@endpush

@section('admin-content')

        <div class="row">
          <div class="col-lg-12 button-area mb-4">
              <a href="{{ route('cashin.create') }}" class="btn btn-md d-btn">Cash In</a>
              <a href="{{ route('cashout.create') }}" class="btn btn-md d-btn">Cash Out</a>
              <a href="{{ route('sale.create') }}" class="btn btn-md d-btn">Sell Memo</a>
              <a href="{{ route('purchase.create') }}" class="btn btn-md d-btn">Purchase Memo</a>
          </div>
        </div>

        <div class="row">
          
          <div class="col-lg-3 col-6">
         
            <div class="small-box cashin">
              <div class="inner">
                <h3> {{ $todaysTotalSales }}</h3>

                <p>Todays CashIn</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          

          <div class="col-lg-3 col-6">
         
            <div class="small-box cashout">
              <div class="inner">
                <h3>{{ $AllCashout }}</h3>

                <p>Todays CashOut</p>
              </div>
              <div class="icon">
                <!-- <i class="ion ion-person-add"></i> -->
                <i class="ion ion-stats-bars"></i>
              </div>
            <!--   <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>


          <div class="col-lg-3 col-6">
         
            <div class="small-box balance">
              <div class="inner">
                <h3>{{ $todaysBalancedMaster }}</h3>

                <p>Todays Balance</p>
              </div>
              <div class="icon">
                <!-- <i class="ion ion-person-add"></i> -->
                <i class="ion ion-stats-bars"></i>
              </div>
             <!--  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>

          <div class="col-lg-3 col-6">
         
            <div class="small-box balance1">
              <div class="inner">
                <h3>{{ $totalBalanceApon }}</h3>

                <p>Total Balance</p>
              </div>
              <div class="icon">
                <!-- <i class="ion ion-person-add"></i> -->
                <i class="ion ion-stats-bars"></i>
              </div>
             <!--  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
        

        </div>
        <!-- /.row -->

        
   <div class="chart-area">
        <div class="row">

       <div class="col-md-9">
         <h5>Monthly Sales Report</h5>
            <canvas id="salesChart" style="width:100%;height: 300px;"></canvas>
        </div> 

       <div class="col-md-3">
         <h5>Total, Paid, Due Sales</h5>
         <canvas id="pieChart" style="width:100%;height: 300px;"></canvas>
        </div>

    </div>
   </div>
    
@endsection


@push('admin-scripts')

  <script>
    // Laravel Blade এর মাধ্যমে PHP ডেটা JavaScript এ প্রেরণ করুন
    const salesData = @json($salesData);
    const months = @json($months);

    // ডেটা প্রসেসিং
    const data = months.map(month => salesData[month]);

    // বার চার্ট কনফিগারেশন
    const ctxBar = document.getElementById('salesChart').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar', // বার চার্ট
        data: {
            labels: months,
            datasets: [{
                label: 'Monthly Sales',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.8)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Total Amount'
                    },
                    beginAtZero: true
                }
            }
        }
    });

    // পাই চার্ট ডেটা

    const totalSales = @json($totalSales);
    const totalPaidSales = @json($totalPaidSales);
    const totalDueSales = @json($totalDueSales);

 const pieData = {
    labels: ['Sales', 'Paid Sales', 'Due Sales'], // চার্টে প্রদর্শিত লেবেল
    datasets: [{
        label: 'Financial Overview',
        data: [totalSales, totalPaidSales, totalDueSales], // ডেটার পরিমাণ
        backgroundColor: [
            'rgba(75, 192, 192, 0.8)', // Sales রঙ
            'rgba(255, 99, 132, 0.8)', // Paid Sales রঙ
            'rgba(255, 159, 64, 0.8)'  // Due Sales রঙ
        ],
        borderColor: [
            'rgba(75, 192, 192, 1)', // Sales সীমানার রঙ
            'rgba(255, 99, 132, 1)', // Paid Sales সীমানার রঙ
            'rgba(255, 159, 64, 1)'  // Due Sales সীমানার রঙ
        ],
        borderWidth: 1 // সীমানার প্রস্থ
    }]
};


  const ctxPie = document.getElementById('pieChart').getContext('2d');
new Chart(ctxPie, {
    type: 'pie', // পাই চার্ট
    data: pieData,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return `${tooltipItem.label}: ${tooltipItem.raw}`;
                    }
                }
            }
        }
    }
});
</script>

@endpush