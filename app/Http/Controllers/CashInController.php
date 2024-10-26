<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CashInType;
use App\Models\CashIn;
use App\Models\CashOut;
use App\Models\BankInformation;
use App\Models\Transaction;
use App\Models\Payment;
use App\Models\CashInPayment;
use App\Models\Sale;
use App\Models\CustomerLedger;
use Carbon\Carbon;
use DB;

class CashInController extends Controller
{
    public function index(){
    	$lists = CashIn::latest()->get();
    	return view('back-end.cashin.index',compact('lists'));
    }

    public function create(){
        $cashInTypes = CashInType::latest()->get();
        $banks = BankInformation::latest()->get();
    	return view('back-end.cashin.create',compact('cashInTypes','banks'));
    }

public function store(Request $request) {
    //validation
    $this->validate($request,[
        "payment_type" => "required",
        "cash_in_type_id" => "required",
        "reason" => "required",
        "amount" => "required",
    ]);

    try {
        DB::beginTransaction();
        
        $cashIn = new CashIn();
        $cashOut = new CashOut();

        // Common fields for both bank and non-bank payments
        $cashIn->payment_type = $request->payment_type;
        $cashIn->cash_in_type_id = $request->cash_in_type_id;
        $cashIn->reason = $request->reason;
        $cashIn->amount = $request->amount;
        $cashIn->month_year = Carbon::today()->format('F Y');
        $cashIn->date = Carbon::today()->format('d-m-Y');

        // Optional fields
        $cashIn->customer_group_id = $request->customer_group_id ?? null;
        $cashIn->customer_id = $request->customer_id ?? null;
        $cashIn->order_no = $request->order_no ?? null;

        if ($request->payment_type == 'bank') {
            $cashIn->bank_information_id = $request->bank_information_id;
        }

        $cashIn->save();
         $cashInId = $cashIn->id;

        /*customer ledger*/

          if (!empty($request->customer_group_id) && !empty($request->customer_id)) {
            $PreviousLedgerBalance = CustomerLedger::orderBy('id', 'desc')
                                                    ->value('balance') ?? 0;
            $ledger = new CustomerLedger();
            $ledger->reference_id = $cashInId;
            $ledger->customer_group_id = $request->customer_group_id;
            $ledger->customer_id = $request->customer_id;
            $ledger->description = $request->reason;
            $ledger->credit = $request->amount;
            $ledger->balance = $PreviousLedgerBalance + $request->amount;
            $ledger->date = Carbon::now()->format('d-m-Y');
            $ledger->month_year = Carbon::now()->format('F Y');
            $ledger->save(); 
        } 

        /*customer ledger*/

        // Handling transactions
       

        $previousBalance = Transaction::orderBy('id', 'desc')->value('balance') ?? 0;
        $transaction = new Transaction();
        $transaction->transaction_type = "cashin";
        $transaction->reference_id = $cashInId;
        $transaction->customer_group_id = $request->customer_group_id ?? null;
        $transaction->customer_id = $request->customer_id ?? null;
        $transaction->memo_no = $request->order_no ?? null;
        $transaction->reason = $request->reason;
        $transaction->credit = $request->amount;
        $transaction->balance = $previousBalance + $request->amount;
        $transaction->date = Carbon::now()->format('d-m-Y');
        $transaction->month_year = Carbon::now()->format('F Y');
        $transaction->save();

        // Update payments only if customer info is provided
        if (!empty($request->customer_group_id) && !empty($request->customer_id) && !empty($request->order_no)) {

            $payment = Payment::where('customer_group_id', $request->customer_group_id)
                              ->where('customer_id', $request->customer_id)
                              ->where('order_no', $request->order_no)
                              ->first();

            Payment::where('customer_group_id', $request->customer_group_id)
                   ->where('customer_id', $request->customer_id)
                   ->where('order_no', $request->order_no)
                   ->update([
                       'paid_amount' => $payment->paid_amount + $request->amount,
                       'due_amount' => $payment->due_amount - $request->amount,
                   ]);
        }

        // Update payments only if customer info is provided
        if (empty($request->customer_group_id) && empty($request->customer_id) && empty($request->order_no)) {
           
            $cashInPayment = new CashInPayment();
            $cashInPayment->payment_type = $request->payment_type;
            $cashInPayment->cash_in_type_id = $request->cash_in_type_id;
            $cashInPayment->reason = $request->reason;
            $cashInPayment->amount = $request->amount;
            $cashInPayment->month_year = Carbon::today()->format('F Y');
            $cashInPayment->date = Carbon::today()->format('d-m-Y');
            $cashInPayment->save();   
        }

        DB::commit();
    } catch (Exception $e) {
        DB::rollBack();
        throw $e;
    }

    return redirect()->route('cashin.index');
}


     public function edit($id){
     	$info = CashIn::findOrFail($id);
        $cashInTypes = CashInType::all();
        $banks = BankInformation::latest()->get();
        $selectedCashInType = $info->cash_in_type_id;
        $selectedCustomerGroup = $info->customer_group_id;
        $selectedCustomer = $info->customer_id;
        $selectedInvoice = $info->order_no;

        return view('back-end.cashin.edit', compact('info','cashInTypes', 'selectedCashInType', 'selectedCustomerGroup', 'selectedCustomer','banks','selectedInvoice'));
    }

public function update(Request $request) {
    // Validation
    $this->validate($request, [
        "payment_type" => "required",
        "cash_in_type_id" => "required",
        "reason" => "required",
        "amount" => "required",
    ]);

    try {
        DB::beginTransaction();

        // Find the existing CashIn record
        $cashIn = CashIn::find($request->id);
        if (!$cashIn) {
            return redirect()->back()->with('error', 'Cash In record not found');
        }

        // Update common fields
        $cashIn->payment_type = $request->payment_type;
        $cashIn->cash_in_type_id = $request->cash_in_type_id;
        $cashIn->reason = $request->reason;
        $cashIn->amount = $request->amount;
        $cashIn->month_year = Carbon::today()->format('F Y');
        $cashIn->date = Carbon::today()->format('d-m-Y');

        // Update optional fields
        $cashIn->customer_group_id = $request->customer_group_id ?? null;
        $cashIn->customer_id = $request->customer_id ?? null;
        $cashIn->order_no = $request->order_no ?? null;

        if ($request->payment_type == 'bank') {
            $cashIn->bank_information_id = $request->bank_information_id;
        } else {
            $cashIn->bank_information_id = null; // Ensure this is null if not bank payment
        }

        $cashIn->save();

        $cashInId = $cashIn->id;

        Transaction::where('transaction_type', 'cashin')
                                  ->where('reference_id', $request->id)
                                  ->delete();

        // Update transaction
        $previousBalance = Transaction::orderBy('id', 'desc')->value('balance') ?? 0;

        $transaction  = new Transaction();
        $transaction->transaction_type = "cashin";
        $transaction->reference_id = $request->id;
        $transaction->reason  = $request->reason;
        $transaction->credit = $request->amount;
        $transaction->balance = $previousBalance + $request->amount;
        $transaction->date = Carbon::now()->format('d-m-Y');
        $transaction->month_year = Carbon::now()->format('F Y');
        $transaction->save();

        // Update payments if customer info is provided
        if (!empty($request->customer_group_id) && !empty($request->customer_id) && !empty($request->order_no)) {
            $payment = Payment::where('customer_group_id', $request->customer_group_id)
                              ->where('customer_id', $request->customer_id)
                              ->where('order_no', $request->order_no)
                              ->first();

             $totalAmountSale = Sale::where('customer_group_id', $request->customer_group_id)
                              ->where('customer_id', $request->customer_id)
                              ->where('order_no', $request->order_no)
                              ->first()->total_amount;

            if ($payment) {
                // Update payment details
                $payment->paid_amount = $request->amount;
                $payment->due_amount = $totalAmountSale - $payment->paid_amount; // Adjust according to your logic
                $payment->save();
            }
        } else {
            // Handle case where customer info is not provided
            $cashInPayment = CashInPayment::where('id', $request->id)->first();
            if (!$cashInPayment) {
                $cashInPayment = new CashInPayment();
            }
            $cashInPayment->payment_type = $request->payment_type;
            $cashInPayment->cash_in_type_id = $request->cash_in_type_id;
            $cashInPayment->reason = $request->reason;
            $cashInPayment->amount = $request->amount;
            $cashInPayment->month_year = Carbon::today()->format('F Y');
            $cashInPayment->date = Carbon::today()->format('d-m-Y');
            $cashInPayment->save();
        }

        DB::commit();
    } catch (Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'An error occurred while updating the record');
    }

    return redirect()->route('cashin.index')->with('success', 'Record updated successfully');
}


public function delete($id){

     	$cashIn = CashIn::findOrFail($id);
     	$cashIn->delete();

        // $cashOut = CashOut::where('cash_in_id',$id);
        // $cashOut->delete();

    	return redirect()->route('cashin.index');
    }
}
