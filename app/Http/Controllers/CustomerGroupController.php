<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerGroup;

class CustomerGroupController extends Controller
{
    public function index(){
    	$lists = CustomerGroup::oldest()->get();
    	return view('back-end.customer.group.index',compact('lists'));
    }

    public function create(){
    	return view('back-end.customer.group.create');
    }

    public function store(Request $request){
    	$info = new CustomerGroup();
    	$info->name  = $request->name;
    	$info->save();
    	return redirect()->route('customer-group.index');
    }

     public function edit($id){
     	$info = CustomerGroup::findOrFail($id);
    	return view('back-end.customer.group.edit',compact('info'));
    }

    public function update(Request $request){
    	$info = CustomerGroup::findOrFail($request->id);
    	$info->name  = $request->name;
    	$info->save();
    	return redirect()->route('customer-group.index');
    }

      public function delete($id){
     	$info = CustomerGroup::findOrFail($id);
     	$info->delete();
    	return redirect()->route('customer-group.index');
    }

}
