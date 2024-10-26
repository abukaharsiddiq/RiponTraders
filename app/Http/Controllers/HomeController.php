<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\CashIn;
use App\Models\CashOut;
use App\Models\Sale;
use App\Models\Payment;
use App\Models\DirectorPayment;
use App\Models\CashInPayment;
use App\Models\PurchasePayment;
use DB;

class HomeController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }

  
    public function index()
    {
        //todays cash in or out
        $today = Carbon::now();
        $todayFormatted = $today->format('d-m-Y');
        $dayName = $today->format('l');

        $previousDate = Carbon::yesterday()->format('d-m-Y');

        $todayPurchase = PurchasePayment::where('date',$todayFormatted)->sum('paid_amount');

        $previousDayPaidSales = Payment::where('date',$previousDate)->sum('paid_amount');
        
        $previousCashIn = CashIn::where('date',$previousDate)->sum('amount');
        $PreviousDayCashOut = CashOut::where('date',$previousDate)->sum('amount');

        $previousDayCashInBalance = $previousDayPaidSales + $previousCashIn;

        $previousDayBalanced = $previousDayCashInBalance - $PreviousDayCashOut;



        $todayCashIn = CashInPayment::where('date',$todayFormatted)->sum('amount');
        
        $cashInApon = CashIn::where('date',$todayFormatted)->sum('amount');
        $todayCashOut = CashOut::where('date',$todayFormatted)->sum('amount');

        //todays sale
         $todaySales = Sale::where('date',$todayFormatted)->sum('total_amount');
         $todayPaidSales = Payment::where('date',$todayFormatted)->sum('paid_amount');
         $todayDueSales = Payment::where('date',$todayFormatted)->sum('due_amount');

         $todaysTotalSales = $todayPaidSales + $cashInApon;

         $AllCashout = $todayPurchase + $todayCashOut; 
         $todaysBalancedMaster = $todaysTotalSales - $AllCashout;

         $totalBalanceApon = $todaysBalancedMaster + $previousDayBalanced;

          //total sale
         $totalSales = Sale::sum('total_amount');
         $totalPaidSales = Payment::sum('paid_amount');
         $totalDueSales = Payment::sum('due_amount');


        $sales = Sale::select(
                DB::raw('MONTH(STR_TO_DATE(date, "%d-%m-%Y")) as month'),
                DB::raw('SUM(total_amount) as total_amount')
            )
            ->whereYear(DB::raw('STR_TO_DATE(date, "%d-%m-%Y")'), date('Y')) // বর্তমান বছরের তথ্য
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($sale) {
                $sale->month_name = date('F', mktime(0, 0, 0, $sale->month, 1)); // মাসের নাম
                return $sale;
            });

        // সব মাসের নাম ও সেলস ডেটা সংগ্রহ
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        $salesData = [];
        foreach ($months as $index => $month) {
            $salesData[$month] = $sales->firstWhere('month_name', $month)->total_amount ?? 0;
        }

        return view('back-end.home.home',compact('todayCashIn','todayCashOut','todaySales','todayPaidSales','todayDueSales','sales','salesData', 'months','totalSales','totalPaidSales','totalDueSales','cashInApon','todaysTotalSales','previousDayBalanced','todaysBalancedMaster','totalBalanceApon','AllCashout'));
    }
}
