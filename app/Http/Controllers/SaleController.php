<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleDetails;
use App\Models\Payment;
use App\Models\Bank;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\CustomerLedger;
use DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleController extends Controller
{

	public function details($order_id){
		$lists = SaleDetails::with('product')->where('order_id',$order_id)->get();
		$payment = Payment::where('order_id',$order_id)->first();
		$sale = Sale::where('id',$order_id)->first()->total_amount;
        return view('back-end.sale.details',compact('lists','payment','sale'));
	}

	public function index(){
		$sales = Sale::with('customer','customer_group')->latest()->get();
        return view('back-end.sale.index',compact('sales'));
	}

     public function create(){

     	$banks = Bank::oldest()->get();
     	$customers = Customer::latest()->get();

	    $latestVoucher = Sale::latest('id')->first();
	    $VoucherNumber = 0;
	    if ($latestVoucher == null) {
	        $VoucherNumber = "STL-000001";
	    } else {
	        $latestVoucherNumber = $latestVoucher->order_no;
	        $VoucherNumber = "STL-" . str_pad(intval(substr($latestVoucherNumber, 4)) + 1, 6, '0', STR_PAD_LEFT);
	    }
    	return view('back-end.sale.create',compact('VoucherNumber','banks','customers'));
    }


    public function store(Request $request){

    	
       
        DB::beginTransaction();
        try {

            // Save the voucher to the DealerVoucher table
            $sale = new Sale();
            $sale->customer_group_id = $request->customer_group_id;
            $sale->customer_id = $request->customer_id;
            $sale->order_no = $request->order_no;
            $sale->total_amount = $request->total_amount;
            $sale->date = Carbon::now()->format('d-m-Y');
            $sale->save();

            $orderId = $sale->id;

            $PreviousLedgerBalance = CustomerLedger::orderBy('id', 'desc')->value('balance') ?? 0;

            $ledger = new CustomerLedger();
            $ledger->reference_id = $orderId;
            $ledger->customer_group_id = $request->customer_group_id;
            $ledger->customer_id = $request->customer_id;
            $ledger->description = "new sale";

            // Check if it's debit or credit transaction
            $creditAmount = $request->paid_amount;
            $debitAmount = $request->total_amount;// If there is a debit

            // Calculate new balance based on the transaction
            $newBalance = $PreviousLedgerBalance + $debitAmount - $creditAmount;

            $ledger->debit = $debitAmount;
            $ledger->credit = $creditAmount;
            $ledger->balance = $newBalance;
            $ledger->date = Carbon::now()->format('d-m-Y');
            $ledger->month_year = Carbon::now()->format('F Y');
            $ledger->save();

            $previousBalance = Transaction::orderBy('id', 'desc')->value('balance') ?? 0;


            $transaction  = new Transaction();
            $transaction->transaction_type = "sale";
            $transaction->reference_id = $orderId;
            $transaction->customer_group_id = $request->customer_group_id;
            $transaction->customer_id = $request->customer_id;
            $transaction->memo_no = $request->order_no;
            $transaction->credit = $request->paid_amount;
            $transaction->balance = $previousBalance + $request->paid_amount;
            $transaction->date = Carbon::now()->format('d-m-Y');
            $transaction->month_year = Carbon::now()->format('F Y');
            $transaction->save();

            

            // Save each product's details to the DealerVoucherDetails table
            $productCount = count($request->product_id);
            for ($i = 0; $i < $productCount; $i++) {
                $saleDetail = new SaleDetails();
                $saleDetail->customer_group_id = $request->customer_group_id;
                $saleDetail->customer_id = $request->customer_id;
                $saleDetail->order_no = $request->order_no;
                $saleDetail->order_id = $orderId;
                $saleDetail->product_group_id = $request->product_group_id[$i];
                $saleDetail->product_id = $request->product_id[$i];
                $saleDetail->quantity = $request->quantity[$i];
                $saleDetail->unit_price = $request->unit_price[$i];
                $saleDetail->unit_total = $request->unit_total[$i];
                $saleDetail->date = Carbon::now()->format('d-m-Y');
                $saleDetail->save();
            }
            
            //payment
            $payment = new Payment();
            $payment->customer_group_id = $request->customer_group_id;
            $payment->customer_id = $request->customer_id;
            $payment->order_id = $orderId;
            $payment->order_no = $request->order_no;
            $payment->paid_amount = $request->paid_amount;
            $payment->due_amount = $request->due_amount;
            $payment->payment_type = $request->payment_type;
            $payment->date = Carbon::now()->format('d-m-Y');
            $payment->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

       return redirect()->route('sale.index');

    }

    public function edit($id){
    	$banks = Bank::oldest()->get();
     	$customers = Customer::latest()->get();
     	$sale = Sale::with('payment','sale_details')->findOrFail($id);
    	return view('back-end.sale.edit',compact('banks','customers','sale'));
    }

    public function update(Request $request){

    	Sale::where('id',$request->id)->delete();
    	SaleDetails::where('order_id',$request->id)->delete();
    	Payment::where('order_id',$request->id)->delete();
        Transaction::where('reference_id',$request->id)->delete();
        CustomerLedger::where('reference_id',$request->id)->delete();

        DB::beginTransaction();
        try {

            // Save the voucher to the DealerVoucher table
            $sale = new Sale();
            $sale->customer_group_id = $request->customer_group_id;
            $sale->customer_id = $request->customer_id;
            $sale->order_no = $request->order_no;
            $sale->total_amount = $request->total_amount;
            $sale->date = Carbon::now()->format('d-m-Y');
            $sale->save();

            $orderId = $sale->id;

            $PreviousLedgerBalance = CustomerLedger::orderBy('id', 'desc')->value('balance') ?? 0;

            $ledger = new CustomerLedger();
            $ledger->reference_id = $orderId;
            $ledger->customer_group_id = $request->customer_group_id;
            $ledger->customer_id = $request->customer_id;
            $ledger->description = "update sale";

            // Check if it's debit or credit transaction
            $creditAmount = $request->paid_amount;
            $debitAmount = $request->total_amount;// If there is a debit

            // Calculate new balance based on the transaction
            $newBalance = $PreviousLedgerBalance + $debitAmount - $creditAmount;

            $ledger->debit = $debitAmount;
            $ledger->credit = $creditAmount;
            $ledger->balance = $newBalance;
            $ledger->date = Carbon::now()->format('d-m-Y');
            $ledger->month_year = Carbon::now()->format('F Y');
            $ledger->save();

            

            // Save each product's details to the DealerVoucherDetails table
            $productCount = count($request->product_id);
            for ($i = 0; $i < $productCount; $i++) {
                $saleDetail = new SaleDetails();
                $saleDetail->customer_group_id = $request->customer_group_id;
                $saleDetail->customer_id = $request->customer_id;
                $saleDetail->order_no = $request->order_no;
                $saleDetail->order_id = $orderId;
                $saleDetail->product_group_id = $request->product_group_id[$i];
                $saleDetail->product_id = $request->product_id[$i];
                $saleDetail->quantity = $request->quantity[$i];
                $saleDetail->unit_price = $request->unit_price[$i];
                $saleDetail->unit_total = $request->unit_total[$i];
                $saleDetail->date = Carbon::now()->format('d-m-Y');
                $saleDetail->save();
            }
            
            //payment
            $payment = new Payment();
            $payment->customer_group_id = $request->customer_group_id;
            $payment->customer_id = $request->customer_id;
            $payment->order_id = $orderId;
            $payment->order_no = $request->order_no;
            $payment->paid_amount = $request->paid_amount;
            $payment->due_amount = $request->due_amount;
            $payment->payment_type = $request->payment_type;
            $payment->date = Carbon::now()->format('d-m-Y');
            $payment->save();

             $previousBalance = Transaction::orderBy('id', 'desc')->value('balance') ?? 0;


            $transaction  = new Transaction();
            $transaction->transaction_type = "sale";
            $transaction->reference_id = $orderId;
            $transaction->customer_group_id = $request->customer_group_id;
            $transaction->customer_id = $request->customer_id;
            $transaction->memo_no = $request->order_no;
            $transaction->credit = $request->paid_amount;
            $transaction->balance = $previousBalance + $request->paid_amount;
            $transaction->date = Carbon::now()->format('d-m-Y');
            $transaction->month_year = Carbon::now()->format('F Y');
            $transaction->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

       return redirect()->route('sale.index');
    }

    public function delete($id) {
	    DB::beginTransaction();
	    
	    try {

	        $sale = Sale::findOrFail($id);
	        $sale->sale_details()->delete();

	        $sale->payment()->delete();
	        $sale->delete();

            Transaction::where('reference_id',$id)->delete();
            CustomerLedger::where('reference_id',$id)->delete();

	        DB::commit();
	    } catch (\Exception $e) {
	        DB::rollback();
	        throw $e;
	    }

	    return redirect()->route('sale.index');
   }

}
