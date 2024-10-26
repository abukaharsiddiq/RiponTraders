<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FactoryGroup;
use App\Models\Factory;
use App\Models\Transaction;
use App\Models\CashOut;
use Carbon\Carbon;
use DB;

class FactoryController extends Controller
{
     public function index(){
      $lists = Factory::with('factory_group')->oldest()->get();
      return view('back-end.factory.index',compact('lists'));
    }

    public function create(){
      $groups = FactoryGroup::oldest()->get();
      return view('back-end.factory.create',compact('groups'));
    }

    public function store(Request $request){
       
       /*validation*/
       $this->validate($request,[
           "factory_group_id"=>"required",
           "reason"=>"required",
           "amount"=>"required",
       ]);

       $info = new Factory();
       $info->factory_group_id = $request->factory_group_id;
       $info->reason = $request->reason;
       $info->amount = $request->amount;
       $info->date = Carbon::today()->format('d-m-Y');
       $info->month_year = Carbon::now()->format('F Y');
       $info->save();


        $factoryId = $info->id;

        $previousBalance = Transaction::orderBy('id', 'desc')->value('balance') ?? 0;
        $transaction  = new Transaction();
        $transaction->transaction_type = "factory-khoroc";
        $transaction->reference_id = $factoryId;
        $transaction->reason  = $request->reason;
        $transaction->debit = $request->amount;
        $transaction->balance = $previousBalance - $request->amount;
        $transaction->date = Carbon::now()->format('d-m-Y');
        $transaction->month_year = Carbon::now()->format('F Y');
        $transaction->save();

        $cashOut = new CashOut();
        $cashOut->payment_type  = "no";
        $cashOut->cash_in_type_id  = 0;
        $cashOut->reason  = $request->reason;
        $cashOut->amount  = $request->amount;
        $cashOut->date = Carbon::now()->format('d-m-Y');
        $cashOut->month_year = Carbon::now()->format('F Y');
        $cashOut->save();

       return redirect()->route('factory.index');
    }

    public function edit($id){
      $info = Factory::findOrFail($id);
      $groups = FactoryGroup::oldest()->get();
      return view('back-end.factory.edit',compact('info','groups'));
    }

 public function update(Request $request) {
    /* Validation */
    $this->validate($request, [
        "factory_group_id" => "required",
        "reason" => "required",
        "amount" => "required",
    ]);

    try {
        DB::beginTransaction();

        // Find the existing factory entry
        $info = Factory::findOrFail($request->id);
        $info->factory_group_id = $request->factory_group_id;
        $info->reason = $request->reason;
        $info->amount = $request->amount;
        $info->date = Carbon::today()->format('d-m-Y');
        $info->month_year = Carbon::now()->format('F Y');
        $info->save();

         $factoryId = $info->id;

        // Update the related transaction
       Transaction::where('transaction_type', 'factory-khoroc')
                                  ->where('reference_id', $info->id)
                                  ->delete();

        $previousBalance = Transaction::orderBy('id', 'desc')->value('balance') ?? 0;
        
        $transaction  = new Transaction();
        $transaction->transaction_type = "factory-khoroc";
        $transaction->reference_id = $factoryId;
        $transaction->reason  = $request->reason;
        $transaction->debit = $request->amount;
        $transaction->balance = $previousBalance - $request->amount;
        $transaction->date = Carbon::now()->format('d-m-Y');
        $transaction->month_year = Carbon::now()->format('F Y');
        $transaction->save();

        DB::commit();

    } catch (\Exception $e) {
        DB::rollBack();
        throw $e;
    }

    return redirect()->route('factory.index');
}



     public function delete($id){
      $info = Factory::findOrFail($id);
      $info->delete();
       return redirect()->route('factory.index');
    }
}
