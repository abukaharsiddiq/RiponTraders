<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankInformation;
use App\Models\BankCalculation;
use App\Models\CashIn;
use App\Models\CashOut;
use App\Models\Transaction;
use Carbon\Carbon;
use DB;

class BankCalculationController extends Controller
{
     public function index(){
    	$lists = BankCalculation::latest()->get();
    	return view('back-end.bank-calculation.index',compact('lists'));
    }

    public function create(){
        $lists = BankInformation::all();
    	return view('back-end.bank-calculation.create',compact('lists'));
    }

    public function store(Request $request){

         DB::beginTransaction();
        try {

    	$info = new BankCalculation();
        $info->bank_information_id  = $request->bank_information_id;
    	$info->date  = Carbon::now()->format('d-m-Y');
    	$info->cal_month  = Carbon::now()->format('F Y');
    	$info->amount  = $request->amount;
    	$info->type  = $request->type;
    	$info->save();

        $bankId = $info->id;

        if($request->type=="widthdraw"){
            $previousBalance = Transaction::orderBy('id', 'desc')->value('balance') ?? 0;
            $transaction  = new Transaction();
            $transaction->transaction_type = "widthdraw";
            $transaction->reference_id = $bankId;
            $transaction->credit = $request->amount;
            $transaction->balance = $previousBalance + $request->amount;
            $transaction->date = Carbon::now()->format('d-m-Y');
            $transaction->month_year = Carbon::now()->format('F Y');
            $transaction->save();

            $cashIn = new CashIn();
            $cashIn->payment_type  = "no";
            $cashIn->cash_in_type_id  = 0;
            $cashIn->reason  = "no";
            $cashIn->amount  = $request->amount;
            $cashIn->date = Carbon::now()->format('d-m-Y');
            $cashIn->month_year = Carbon::now()->format('F Y');
            $cashIn->save();

        }else if($request->type=="deposit"){
            $previousBalance = Transaction::orderBy('id', 'desc')->value('balance') ?? 0;
            $transaction  = new Transaction();
            $transaction->transaction_type = "deposit";
            $transaction->reference_id = $bankId;
            $transaction->debit = $request->amount;
            $transaction->balance = $previousBalance - $request->amount;
            $transaction->date = Carbon::now()->format('d-m-Y');
            $transaction->month_year = Carbon::now()->format('F Y');
            $transaction->save();

            $cashOut = new CashOut();
            $cashOut->payment_type  = "no";
            $cashOut->cash_in_type_id  = 0;
            $cashOut->reason  = "no";
            $cashOut->amount  = $request->amount;
            $cashOut->date = Carbon::now()->format('d-m-Y');
            $cashOut->month_year = Carbon::now()->format('F Y');
            $cashOut->save();
        }

              DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

    	return redirect()->route('bank-calculation.index');
    }

     public function edit($id){
     	$lists = BankInformation::all();
     	$info = BankCalculation::findOrFail($id);
    	return view('back-end.bank-calculation.edit',compact('info','lists'));
    }

    public function update(Request $request){
    	$info = BankCalculation::findOrFail($request->id);
    	$info->bank_information_id  = $request->bank_information_id;
    	$info->date  = Carbon::now()->format('d-m-Y');
    	$info->cal_month  = Carbon::now()->format('F Y');
    	$info->amount  = $request->amount;
    	$info->type  = $request->type;
    	$info->save();
    	return redirect()->route('bank-calculation.index');
    }

      public function delete($id){
     	$info = BankCalculation::findOrFail($id);
     	$info->delete();
    	return redirect()->route('bank-calculation.index');
    }
}
