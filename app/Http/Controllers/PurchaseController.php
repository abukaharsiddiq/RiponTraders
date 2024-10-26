<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Models\PurchasePayment;
use App\Models\Bank;
use App\Models\Customer;
use App\Models\Transaction;
use DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class PurchaseController extends Controller
{
    public function details($purchase_id){

        $condition =['purchase_id'=>$purchase_id];

		$lists = PurchaseDetails::with('product')->where($condition)->get();
		$payment = PurchasePayment::where($condition)->first();
		$purchase = Purchase::where('id',$purchase_id)->first()->total_amount;
        return view('back-end.purchase.details',compact('lists','payment','purchase'));
	}

	public function index(){
		$purchases = Purchase::with('customer','customer_group')->latest()->get();
        return view('back-end.purchase.index',compact('purchases'));
	}

     public function create(){

     	$banks = Bank::oldest()->get();
     	$customers = Customer::latest()->get();

	    $latestVoucher = Purchase::latest('id')->first();
	    $VoucherNumber = 0;
	    if ($latestVoucher == null) {
	        $VoucherNumber = "PO-000001";
	    } else {
	        $latestVoucherNumber = $latestVoucher->purchase_no;
	        $VoucherNumber = "PO-" . str_pad(intval(substr($latestVoucherNumber, 4)) + 1, 6, '0', STR_PAD_LEFT);
	    }
    	return view('back-end.purchase.create',compact('VoucherNumber','banks','customers'));
    }


    public function store(Request $request){

        DB::beginTransaction();
        try {

            // Save the voucher to the DealerVoucher table
            $purchase = new Purchase();
            $purchase->customer_group_id = $request->customer_group_id;
            $purchase->customer_id = $request->customer_id;
            $purchase->purchase_no = $request->purchase_no;
            $purchase->total_amount = $request->total_amount;
            $purchase->date = Carbon::now()->format('d-m-Y');
            $purchase->save();

            $purchaseId = $purchase->id;

            $previousBalance = Transaction::orderBy('id', 'desc')->value('balance') ?? 0;


            $transaction  = new Transaction();
            $transaction->transaction_type = "purchase";
            $transaction->reference_id = $purchaseId;
            $transaction->customer_group_id = $request->customer_group_id;
            $transaction->customer_id = $request->customer_id;
            $transaction->memo_no = $request->purchase_no;
            $transaction->debit = $request->paid_amount;
            $transaction->balance = $previousBalance - $request->paid_amount;
            $transaction->date = Carbon::now()->format('d-m-Y');
            $transaction->month_year = Carbon::now()->format('F Y');
            $transaction->save();

            // Save each product's details to the DealerVoucherDetails table
            $productCount = count($request->product_id);
            for ($i = 0; $i < $productCount; $i++) {
                $purchaseDetail = new PurchaseDetails();
                $purchaseDetail->customer_group_id = $request->customer_group_id;
                $purchaseDetail->customer_id = $request->customer_id;
                $purchaseDetail->purchase_no = $request->purchase_no;
                $purchaseDetail->purchase_id = $purchaseId;
                $purchaseDetail->product_group_id = $request->product_group_id[$i];
                $purchaseDetail->product_id = $request->product_id[$i];
                $purchaseDetail->quantity = $request->quantity[$i];
                $purchaseDetail->unit_price = $request->unit_price[$i];
                $purchaseDetail->unit_total = $request->unit_total[$i];
                $purchaseDetail->date = Carbon::now()->format('d-m-Y');
                $purchaseDetail->save();
            }
            
            //payment
            $purchasepayment = new PurchasePayment();
            $purchasepayment->customer_group_id = $request->customer_group_id;
            $purchasepayment->customer_id = $request->customer_id;
            $purchasepayment->purchase_id = $purchaseId;
            $purchasepayment->purchase_no = $request->purchase_no;
            $purchasepayment->paid_amount = $request->paid_amount;
            $purchasepayment->due_amount = $request->due_amount;
            $purchasepayment->payment_type = $request->payment_type;
            $purchasepayment->date = Carbon::now()->format('d-m-Y');
            $purchasepayment->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

       return redirect()->route('purchase.index');

    }

    public function edit($id){
    	$banks = Bank::oldest()->get();
     	$customers = Customer::latest()->get();
     	$purchase = Purchase::with('payment','purchase_details')->findOrFail($id);
    	return view('back-end.purchase.edit',compact('banks','customers','purchase'));
    }

    public function update(Request $request){

    	Purchase::where('id',$request->id)->delete();
    	PurchaseDetails::where('purchase_id',$request->id)->delete();
    	PurchasePayment::where('purchase_id',$request->id)->delete();
        Transaction::where('reference_id',$request->id)->delete();

        DB::beginTransaction();
        try {

            // Save the voucher to the DealerVoucher table
            $purchase = new Purchase();
            $purchase->customer_group_id = $request->customer_group_id;
            $purchase->customer_id = $request->customer_id;
            $purchase->purchase_no = $request->purchase_no;
            $purchase->total_amount = $request->total_amount;
            $purchase->date = Carbon::now()->format('d-m-Y');
            $purchase->save();

            $orderId = $purchase->id;

             $purchaseId = $purchase->id;

            $previousBalance = Transaction::orderBy('id', 'desc')->value('balance') ?? 0;


            $transaction  = new Transaction();
            $transaction->transaction_type = "purchase";
            $transaction->reference_id = $purchaseId;
            $transaction->customer_group_id = $request->customer_group_id;
            $transaction->customer_id = $request->customer_id;
            $transaction->memo_no = $request->purchase_no;
            $transaction->debit = $request->paid_amount;
            $transaction->balance = $previousBalance - $request->paid_amount;
            $transaction->date = Carbon::now()->format('d-m-Y');
            $transaction->month_year = Carbon::now()->format('F Y');
            $transaction->save();

            

            // Save each product's details to the DealerVoucherDetails table
            $productCount = count($request->product_id);
            for ($i = 0; $i < $productCount; $i++) {
                $purchaseDetail = new PurchaseDetails();
                $purchaseDetail->customer_group_id = $request->customer_group_id;
                $purchaseDetail->customer_id = $request->customer_id;
                $purchaseDetail->purchase_no = $request->purchase_no;
                $purchaseDetail->purchase_id = $orderId;
                $purchaseDetail->product_group_id = $request->product_group_id[$i];
                $purchaseDetail->product_id = $request->product_id[$i];
                $purchaseDetail->quantity = $request->quantity[$i];
                $purchaseDetail->unit_price = $request->unit_price[$i];
                $purchaseDetail->unit_total = $request->unit_total[$i];
                $purchaseDetail->date = Carbon::now()->format('d-m-Y');
                $purchaseDetail->save();
            }
            
            //payment
            $purchasePayment = new PurchasePayment();
            $purchasePayment->customer_group_id = $request->customer_group_id;
            $purchasePayment->customer_id = $request->customer_id;
            $purchasePayment->purchase_id = $orderId;
            $purchasePayment->purchase_no = $request->purchase_no;
            $purchasePayment->paid_amount = $request->paid_amount;
            $purchasePayment->due_amount = $request->due_amount;
            $purchasePayment->payment_type = $request->payment_type;
            $purchasePayment->date = Carbon::now()->format('d-m-Y');
            $purchasePayment->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

       return redirect()->route('purchase.index');
    }

    public function delete($id) {
	    DB::beginTransaction();
	    
	    try {

	        $purchase = Purchase::findOrFail($id);
	        $purchase->purchase_details()->delete();

	        $purchase->payment()->delete();
	        $purchase->delete();

	        DB::commit();
	    } catch (\Exception $e) {
	        DB::rollback();
	        throw $e;
	    }

	    return redirect()->route('purchase.index');
   }
}
