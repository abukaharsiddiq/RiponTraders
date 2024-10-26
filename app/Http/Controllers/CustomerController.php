<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerGroup;
use App\Models\CustomerLedger;

class CustomerController extends Controller
{
    public function index(){
    	$lists = Customer::latest()->get();
    	return view('back-end.customer.index',compact('lists'));
    }

    public function create(){
        $groups = CustomerGroup::all();
    	return view('back-end.customer.create',compact('groups'));
    }

    public function store(Request $request){
    	$info = new Customer();
    	$info->seller_buyer  = $request->seller_buyer;
        $info->customer_group_id  = $request->customer_group_id;
        $info->name  = $request->name;
    	$info->phone  = $request->phone;
    	$info->address  = $request->address;
    	$info->save();
    	return redirect()->route('customer.index');
    }

     public function edit($id){
     	$info = Customer::findOrFail($id);
        $groups = CustomerGroup::all();
    	return view('back-end.customer.edit',compact('info','groups'));
    }

    public function update(Request $request){
    	$info = Customer::findOrFail($request->id);
        $info->seller_buyer  = $request->seller_buyer;
    	$info->customer_group_id  = $request->customer_group_id;
        $info->name  = $request->name;
    	$info->phone  = $request->phone;
    	$info->address  = $request->address;
    	$info->save();
    	return redirect()->route('customer.index');
    }

    public function delete($id){
     	$info = Customer::findOrFail($id);
     	$info->delete();
    	return redirect()->route('customer.index');
    }

    public function ledger(){
        $lists = Customer::latest()->get();
        return view('back-end.customer.ledger',compact('lists'));
    }


public function ledger_details($customerId){
    
    $customer = Customer::find($customerId);
    $ledgerEntries = CustomerLedger::where('customer_id', $customerId)
                                    ->orderBy('date', 'asc')
                                    ->get();


    $runningBalance = 0;
    foreach ($ledgerEntries as $entry) {
        $runningBalance += ($entry->credit - $entry->debit);
        $entry->running_balance = $runningBalance;
    }

    // Pass the ledger entries to a view to display
    return view('back-end.customer.ledger-details', compact('ledgerEntries', 'customer'));
}




}
