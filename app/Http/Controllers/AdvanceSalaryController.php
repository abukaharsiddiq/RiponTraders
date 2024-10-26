<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdvanceSalary;
use App\Models\Employee;
use App\Models\Transaction;
use App\Models\CashOut;
use Carbon\Carbon;
use DB;

class AdvanceSalaryController extends Controller
{
    public function index(){
      $lists = AdvanceSalary::oldest()->get();
      return view('back-end.advance-salary.index',compact('lists'));
    }

    public function create(){
      $employees = Employee::oldest()->get();
      return view('back-end.advance-salary.create',compact('employees'));
    }

    public function store(Request $request){
       
       /*validation*/
       $this->validate($request,[
           "employee_id"=>"required",
           "amount"=>"required",
       ]);

       DB::beginTransaction();
        try {

       $info = new AdvanceSalary();
       $info->employee_id = $request->employee_id;
       $info->amount = $request->amount;
       $info->date = Carbon::today()->format('d-m-Y');
       $info->save();

       $adId = $info->id;

      $previousBalance = Transaction::orderBy('id', 'desc')->value('balance') ?? 0;

      $transaction  = new Transaction();
      $transaction->transaction_type = "advance-salary";
      $transaction->reference_id = $adId;
      $transaction->debit = $request->amount;
      $transaction->balance = $previousBalance - $request->amount;
      $transaction->date = Carbon::now()->format('d-m-Y');
      $transaction->month_year = Carbon::now()->format('F Y');
      $transaction->save();

      $cashOut = new CashOut();
      $cashOut->advance_salary_id  = $adId;
      $cashOut->payment_type  = "no";
      $cashOut->cash_in_type_id  = 0;
      $cashOut->reason  = "advance-salary";
      $cashOut->amount  = $request->amount;
      $cashOut->date = Carbon::now()->format('d-m-Y');
      $cashOut->month_year = Carbon::now()->format('F Y');
      $cashOut->save();

             DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

       return redirect()->route('advance-salary.index');
    }

    public function edit($id){
      $info = AdvanceSalary::findOrFail($id);
      $employees = Employee::oldest()->get();
      return view('back-end.advance-salary.edit',compact('info','employees'));
    }

public function update(Request $request){
     

       AdvanceSalary::where('id',$request->id)->delete();
       CashOut::where('advance_salary_id',$request->id)->delete();
       Transaction::where('reference_id',$request->id)->delete();

       DB::beginTransaction();
        try {
       

       $info = new AdvanceSalary();
       $info->employee_id = $request->employee_id;
       $info->amount = $request->amount;
       $info->date = Carbon::today()->format('d-m-Y');
       $info->save();

       $adId = $info->id;

      $cashOut = new CashOut();
      $cashOut->advance_salary_id  = $adId;
      $cashOut->payment_type  = "no";
      $cashOut->cash_in_type_id  = 0;
      $cashOut->reason  = "advance-salary";
      $cashOut->amount  = $request->amount;
      $cashOut->date = Carbon::now()->format('d-m-Y');
      $cashOut->month_year = Carbon::now()->format('F Y');
      $cashOut->save();

      $previousBalance = Transaction::orderBy('id', 'desc')->value('balance') ?? 0;

      $transaction  = new Transaction();
      $transaction->transaction_type = "advance-salary";
      $transaction->reference_id = $adId;
      $transaction->reason  = "advance-salary";
      $transaction->debit = $request->amount;
      $transaction->balance = $previousBalance - $request->amount;
      $transaction->date = Carbon::now()->format('d-m-Y');
      $transaction->month_year = Carbon::now()->format('F Y');
      $transaction->save();

             DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

       return redirect()->route('advance-salary.index');

    }

     public function delete($id){
      $info = AdvanceSalary::findOrFail($id);
      $info->delete();
       return redirect()->route('advance-salary.index');
    }
}
