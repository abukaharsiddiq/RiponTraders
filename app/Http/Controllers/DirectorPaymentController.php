<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Director;
use App\Models\DirectorPayment;
use Carbon\Carbon;

class DirectorPaymentController extends Controller
{
     public function index(){
    	$lists = DirectorPayment::latest()->get();
    	return view('back-end.director-payment.index',compact('lists'));
    }

    public function create(){
        $lists = Director::all();
    	return view('back-end.director-payment.create',compact('lists'));
    }

    public function store(Request $request){
    	$info = new DirectorPayment();
        $info->director_id  = $request->director_id;
    	$info->date  = Carbon::now()->format('d-m-Y');
    	$info->pay_month  = Carbon::now()->format('F Y');
    	$info->amount  = $request->amount;
    	$info->save();
    	return redirect()->route('director-payment.index');
    }

     public function edit($id){
     	$lists = Director::all();
     	$info = DirectorPayment::findOrFail($id);
    	return view('back-end.director-payment.edit',compact('info','lists'));
    }

    public function update(Request $request){
    	$info = DirectorPayment::findOrFail($request->id);
    	$info->director_id  = $request->director_id;
    	$info->date  = Carbon::now()->format('d-m-Y');
    	$info->pay_month  = Carbon::now()->format('F Y');
    	$info->amount  = $request->amount;
    	$info->save();
    	return redirect()->route('director-payment.index');
    }

      public function delete($id){
     	$info = DirectorPayment::findOrFail($id);
     	$info->delete();
    	return redirect()->route('director-payment.index');
    }
}
