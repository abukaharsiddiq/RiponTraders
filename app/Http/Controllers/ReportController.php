<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Models\PurchasePayment;

use App\Models\Sale;
use App\Models\SaleDetails;
use App\Models\Payment;

use App\Models\CashIn;
use App\Models\CashOut;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\AdvanceSalary;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ReportController extends Controller
{


    public function customer_payment(){
        $customers = Customer::all();
        $apon = [];
        foreach($customers as $data){
           

                $saleTotalAmount = Sale::where('customer_id',$data->id)->sum('total_amount');
                $CashInTotalPaidAmount = CashIn::where('customer_id',$data->id)->sum('amount');

                $PaymentTotalPaidAmount = Payment::where('customer_id',$data->id)->sum('paid_amount');

                $totalPaidAmount = $CashInTotalPaidAmount + $PaymentTotalPaidAmount;

                $apon[] = array(
                    "customer_name"=>$data->name,
                    "total_amount"=>$saleTotalAmount,
                    "paid_amount"=>$totalPaidAmount,
                );
          
        }
        return view('back-end.report.customer-payment',['lists'=>$apon]);
    }


    public function account_statement(Request $request){
        // Check if the request has a date input
        if ($request->has('date')) {
            // Parse the provided date
            $today = Carbon::parse($request->date);
        } else {
            // Use the current date if no date is provided
            $today = Carbon::now();
        }

        // Format the date for display
        $todayFormatted = $today->format('d-m-Y');

        // Query transactions for the provided date in 'Y-m-d' format
        $todaysTransaction = Transaction::where('date', $todayFormatted)->get();

        // Get the last balance
        $lastBalance = Transaction::orderBy('id', 'desc')->first()->balance??'0';

        // Return the view with the balance and transactions
        return view('back-end.report.account-statement', compact('lastBalance', 'todaysTransaction'));
    }


    public function product_history($product_id){
       $sale_details = SaleDetails::where('product_id',$product_id)->get();
       $purchase_details = PurchaseDetails::where('product_id',$product_id)->get();
       return view('back-end.report.product-history',compact('sale_details','purchase_details'));
    }

    public function purchase_print($id){

           set_time_limit(300);

    	$purchase = Purchase::where('id',$id)->first();
    	$purchaseDetails = PurchaseDetails::where('purchase_id',$id)->get();
        
        $pdf = Pdf::loadView('back-end.purchase.pdf', compact('purchase', 'purchaseDetails'));
        return $pdf->stream('purchase-invoice.pdf');
    }

    public function sale_print($id){
        $sale = Sale::where('id',$id)->first();
        $saleDetails = SaleDetails::where('order_id',$id)->get();
        
        $pdf = Pdf::loadView('back-end.sale.pdf', compact('sale', 'saleDetails'))->setOptions([
             'defaultFont' => 'sans-serif',
             'isHtml5ParserEnabled' => true,
             'isRemoteEnabled' => true,
             'isPhpEnabled' => true,
          ]);
        return $pdf->stream('invoice.pdf');
    }

    public function bank(){
    	$bankSales = Payment::where('payment_type','bank')->get();
        return view('back-end.report.bank',compact('bankSales'));
    }

    public function cash(){
    	$cashSales = Payment::where('payment_type','cash')->get();
        return view('back-end.report.cash',compact('cashSales'));
    }

    public function cashin(){
    	$lists = CashIn::latest()->get();
        return view('back-end.report.cashin',compact('lists'));
    }

    public function cashout(){
    	$lists = CashOut::latest()->get();
        return view('back-end.report.cashout',compact('lists'));
    }

    public function total_due(){
    	$lists = Payment::with('customer')->where('due_amount','!=','0')->get();
        return view('back-end.report.total-due',compact('lists'));
    }

    public function customer_due(){
    	$customers = Customer::all();
    	$apon = [];
    	foreach($customers as $data){
    		if(Payment::where('customer_id',$data->id)->exists()){
    			$dueAmount = Payment::where('customer_id',$data->id)->sum('due_amount');

    			$apon[] = array(
    				"customer_name"=>$data->name,
    				"customer_phone"=>$data->phone,
    				"total_due"=>$dueAmount,
    			);
    		}
    	}

        return view('back-end.report.customer-due',['lists'=>$apon]);
    }

	public function employee_salary() {
        $employees = Employee::all();
        $apon = [];

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $currentMonthName = Carbon::now()->format('F');

        foreach ($employees as $data) {
            $advanceSalaries = AdvanceSalary::where('employee_id', $data->id)->get();
            $totalAdvanceAmount = 0;
            
            foreach ($advanceSalaries as $salary) {
                try {
                    $salaryDate = Carbon::createFromFormat('d-m-Y', $salary->date);
                    if ($salaryDate->month == $currentMonth && $salaryDate->year == $currentYear) {
                        $totalAdvanceAmount += $salary->amount;
                    }
                } catch (\Exception $e) {
                   
                    // dd($e->getMessage());
                }
            }

        
            if ($totalAdvanceAmount > 0) {
                $apon[] = [
                    "employee_name" => $data->name,
                    "employee_phone" => $data->phone,
                    "employee_salary" => $data->salary,
                    "advance_amount" => $totalAdvanceAmount,
                ];
            } else {
                $apon[] = [
                    "employee_name" => $data->name,
                    "employee_phone" => $data->phone,
                    "employee_salary" => $data->salary,
                    "advance_amount" => 0,
                ];
            }
        }
        return view('back-end.report.employee-salary', ['lists' => $apon, 'currentMonthName' => $currentMonthName]);
   }

  public function sale_history($customer_group_id, $customer_id){

    $sales = Sale::with('customer','customer_group')
                   ->where('customer_group_id', $customer_group_id)
                   ->where('customer_id', $customer_id)
                   ->get();
    $apon = [];
    $customer_group_name='';
    $customer_name='';
    foreach($sales as $data){

        $customer_group_name  = $data->customer_group->name;
        $customer_name  = $data->customer->name;

         $condition = ['customer_group_id'=>$data->customer_group_id,'customer_id'=>$data->customer_id,'order_no'=>$data->order_no];

         if(Payment::where($condition)->exists()){
            $paymentInfo = Payment::where($condition)->first();
            $apon[] = [
                "order_id"=>$paymentInfo->order_id,
                "order_no"=>$data->order_no,
                "total_amount"=>$data->total_amount,
                "paid_amount"=>$paymentInfo->paid_amount,
                "balance"=>$data->total_amount - $paymentInfo->paid_amount,
                "date"=>$paymentInfo->date,
            ];
         }
    }

    return view('back-end.customer.sale_history',['lists'=>$apon,'customer_group_name'=>$customer_group_name,'customer_name'=>$customer_name]);
}

}
