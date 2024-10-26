<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CashInType;
use App\Models\CashIn;
use App\Models\CashOut;
use App\Models\BankInformation;
use App\Models\Transaction;
use Carbon\Carbon;
use DB;

class CashOutController extends Controller
{
     public function index(){
    	$lists = CashOut::latest()->get();
    	return view('back-end.cashout.index',compact('lists'));
    }

    public function create(){
         $cashInTypes = CashInType::latest()->get();
         $banks = BankInformation::latest()->get();
    	return view('back-end.cashout.create',compact('cashInTypes','banks'));
    }

    public function store(Request $request){
    	//validation
        $this->validate($request,[
            "payment_type"=>"required",
            "cash_in_type_id"=>"required",
            "reason"=>"required",
            "amount"=>"required",
        ]);


        try{

              DB::beginTransaction();

            $cashIn = new CashIn();
            $cashOut = new CashOut();

            if($request->payment_type=='bank'){

                $cashOut->payment_type  = $request->payment_type;
                $cashOut->bank_information_id  = $request->bank_information_id;
                $cashOut->cash_in_type_id  = $request->cash_in_type_id;
                $cashOut->customer_group_id  = $request->customer_group_id;
                $cashOut->customer_id  = $request->customer_id;
                $cashOut->reason  = $request->reason;
                $cashOut->amount  = $request->amount;
                $cashOut->month_year  = Carbon::today()->format('F Y');
                $cashOut->date  = Carbon::today()->format('d-m-Y');
                $cashOut->save();

                $cashOutId = $cashOut->id;

                $previousBalance = Transaction::orderBy('id', 'desc')->value('balance') ?? 0;
                $transaction  = new Transaction();
                $transaction->transaction_type = "cashout";
                $transaction->reference_id = $cashOutId;
                $transaction->customer_group_id = $request->customer_group_id;
                $transaction->customer_id = $request->customer_id;
                $transaction->reason  = $request->reason;
                $transaction->debit = $request->amount;
                $transaction->balance = $previousBalance - $request->amount;
                $transaction->date = Carbon::now()->format('d-m-Y');
                $transaction->month_year = Carbon::now()->format('F Y');
                $transaction->save();

                // $cashIn->cash_out_id  = $cashOutId;
                // $cashIn->bank_information_id  = $request->bank_information_id;
                // $cashIn->payment_type  = $request->payment_type;
                // $cashIn->cash_in_type_id  = $request->cash_in_type_id;
                // $cashIn->customer_group_id  = $request->customer_group_id;
                // $cashIn->customer_id  = $request->customer_id;
                // $cashIn->reason  = $request->reason;
                // $cashIn->amount  = $request->amount;
                // $cashIn->month_year  = Carbon::today()->format('F Y');
                // $cashIn->date  = Carbon::today()->format('d-m-Y');
                // $cashIn->save();
                
            }else{
                $cashOut->bank_information_id  = null;
                $cashOut->payment_type  = $request->payment_type;
                $cashOut->cash_in_type_id  = $request->cash_in_type_id;
                $cashOut->customer_group_id  = $request->customer_group_id;
                $cashOut->customer_id  = $request->customer_id;
                $cashOut->reason  = $request->reason;
                $cashOut->amount  = $request->amount;
                $cashOut->month_year  = Carbon::today()->format('F Y');
                $cashOut->date  = Carbon::today()->format('d-m-Y');
                $cashOut->save();

                $cashOutId = $cashOut->id;

                // $cashIn->cash_out_id  = $cashOutId;
                // $cashIn->bank_information_id  = $request->bank_information_id;
                // $cashIn->payment_type  = $request->payment_type;
                // $cashIn->cash_in_type_id  = $request->cash_in_type_id;
                // $cashIn->customer_group_id  = $request->customer_group_id;
                // $cashIn->customer_id  = $request->customer_id;
                // $cashIn->reason  = $request->reason;
                // $cashIn->amount  = $request->amount;
                // $cashIn->month_year  = Carbon::today()->format('F Y');
                // $cashIn->date  = Carbon::today()->format('d-m-Y');
                // $cashIn->save();

                $previousBalance = Transaction::orderBy('id', 'desc')->value('balance') ?? 0;
                $transaction  = new Transaction();
                $transaction->transaction_type = "cashout";
                $transaction->reference_id = $cashOutId;
                $transaction->customer_group_id = $request->customer_group_id;
                $transaction->customer_id = $request->customer_id;
                $transaction->reason  = $request->reason;
                $transaction->debit = $request->amount;
                $transaction->balance = $previousBalance - $request->amount;
                $transaction->date = Carbon::now()->format('d-m-Y');
                $transaction->month_year = Carbon::now()->format('F Y');
                $transaction->save();
            }

            DB::commit();

        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }
    	return redirect()->route('cashout.index');
    }

     public function edit($id){
     	$info = CashOut::findOrFail($id);
        $cashInTypes = CashInType::all();
        $banks = BankInformation::latest()->get();
        $selectedCashInType = $info->cash_in_type_id;
        $selectedCustomerGroup = $info->customer_group_id;
        $selectedCustomer = $info->customer_id;

    	return view('back-end.cashout.edit', compact('info','cashInTypes', 'selectedCashInType', 'selectedCustomerGroup', 'selectedCustomer','banks'));
    }

    public function update(Request $request){
    	// Validation
    $this->validate($request, [
        "payment_type" => "required",
        "cash_in_type_id" => "required",
        "reason" => "required",
        "amount" => "required",
    ]);


        CashIn::where('cash_out_id',$request->id)->delete();
        CashOut::where('id',$request->id)->delete();
        Transaction::where('reference_id',$request->id)->delete();

   try{

              DB::beginTransaction();

            $cashIn = new CashIn();
            $cashOut = new CashOut();

            if($request->payment_type=='bank'){

                $cashOut->payment_type  = $request->payment_type;
                $cashOut->bank_information_id  = $request->bank_information_id;
                $cashOut->cash_in_type_id  = $request->cash_in_type_id;
                $cashOut->customer_group_id  = $request->customer_group_id;
                $cashOut->customer_id  = $request->customer_id;
                $cashOut->reason  = $request->reason;
                $cashOut->amount  = $request->amount;
                $cashOut->month_year  = Carbon::today()->format('F Y');
                $cashOut->date  = Carbon::today()->format('d-m-Y');
                $cashOut->save();

                $cashOutId = $cashOut->id;

                Transaction::where('transaction_type', 'cashin')
                                  ->where('reference_id', $request->id)
                                  ->delete();

                $previousBalance = Transaction::orderBy('id', 'desc')->value('balance') ?? 0;

                $transaction  = new Transaction();
                $transaction->transaction_type = "cashout";
                $transaction->reference_id = $cashOutId;
                $transaction->customer_group_id = $request->customer_group_id;
                $transaction->customer_id = $request->customer_id;
                $transaction->reason  = $request->reason;
                $transaction->debit = $request->amount;
                $transaction->balance = $previousBalance - $request->amount;
                $transaction->date = Carbon::now()->format('d-m-Y');
                $transaction->month_year = Carbon::now()->format('F Y');
                $transaction->save();

                $cashIn->cash_out_id  = $cashOutId;
                $cashIn->bank_information_id  = $request->bank_information_id;
                $cashIn->payment_type  = $request->payment_type;
                $cashIn->cash_in_type_id  = $request->cash_in_type_id;
                $cashIn->customer_group_id  = $request->customer_group_id;
                $cashIn->customer_id  = $request->customer_id;
                $cashIn->reason  = $request->reason;
                $cashIn->amount  = $request->amount;
                $cashIn->month_year  = Carbon::today()->format('F Y');
                $cashIn->date  = Carbon::today()->format('d-m-Y');
                $cashIn->save();
                
            }else{
                $cashOut->bank_information_id  = null;
                $cashOut->payment_type  = $request->payment_type;
                $cashOut->cash_in_type_id  = $request->cash_in_type_id;
                $cashOut->customer_group_id  = $request->customer_group_id;
                $cashOut->customer_id  = $request->customer_id;
                $cashOut->reason  = $request->reason;
                $cashOut->amount  = $request->amount;
                $cashOut->month_year  = Carbon::today()->format('F Y');
                $cashOut->date  = Carbon::today()->format('d-m-Y');
                $cashOut->save();

                $cashOutId = $cashOut->id;

                 $cashIn->cash_out_id  = $cashOutId;
                $cashIn->bank_information_id  = $request->bank_information_id;
                $cashIn->payment_type  = $request->payment_type;
                $cashIn->cash_in_type_id  = $request->cash_in_type_id;
                $cashIn->customer_group_id  = $request->customer_group_id;
                $cashIn->customer_id  = $request->customer_id;
                $cashIn->reason  = $request->reason;
                $cashIn->amount  = $request->amount;
                $cashIn->month_year  = Carbon::today()->format('F Y');
                $cashIn->date  = Carbon::today()->format('d-m-Y');
                $cashIn->save();

                $previousBalance = Transaction::orderBy('id', 'desc')->value('balance') ?? 0;
                $transaction  = new Transaction();
                $transaction->transaction_type = "cashout";
                $transaction->reference_id = $cashOutId;
                $transaction->customer_group_id = $request->customer_group_id;
                $transaction->customer_id = $request->customer_id;
                $transaction->reason  = $request->reason;
                $transaction->debit = $request->amount;
                $transaction->balance = $previousBalance - $request->amount;
                $transaction->date = Carbon::now()->format('d-m-Y');
                $transaction->month_year = Carbon::now()->format('F Y');
                $transaction->save();
            }

            DB::commit();

        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }

    	return redirect()->route('cashout.index');
    }

      public function delete($id){
     	$info = CashOut::findOrFail($id);
     	$info->delete();

        $cashIn = CashIn::where('cash_out_id',$id);
        $cashIn->delete();

    	return redirect()->route('cashout.index');
    }
}
