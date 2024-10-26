<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CashInType;
use App\Models\CustomerGroup;
use App\Models\CashInTypeAssign;

class CashInTypeAssignController extends Controller
{
    public function index(){
    	$lists = CashInTypeAssign::latest()->get();
    	return view('back-end.cashintype-assign.index',compact('lists'));
    }

    public function create(){
        $customerGroups = CustomerGroup::all();
        $cashInTypes = CashInType::all();
    	return view('back-end.cashintype-assign.create',compact('cashInTypes','customerGroups'));
    }

    public function store(Request $request){
    	$info = new CashInTypeAssign();
        $info->cash_in_type_id  = $request->cash_in_type_id;
        $info->customer_group_id  = $request->customer_group_id;
    	$info->save();
    	return redirect()->route('cashintype-assign.index');
    }

     public function edit($id){
     	$info = CashInTypeAssign::findOrFail($id);
     	$cashInTypes = CashInType::all();
     	$customerGroups = CustomerGroup::all();
    	return view('back-end.cashintype-assign.edit',compact('info','cashInTypes','customerGroups'));
    }

    public function update(Request $request){
    	$info = CashInTypeAssign::findOrFail($request->id);
    	$info->cash_in_type_id  = $request->cash_in_type_id;
        $info->customer_group_id  = $request->customer_group_id;
    	$info->save();
    	return redirect()->route('cashintype-assign.index');
    }

      public function delete($id){
     	$info = CashInTypeAssign::findOrFail($id);
     	$info->delete();
    	return redirect()->route('cashintype-assign.index');
    }
}
