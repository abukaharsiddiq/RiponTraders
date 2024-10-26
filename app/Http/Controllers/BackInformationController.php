<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankInformation;
use App\Models\BankCalculation;

class BackInformationController extends Controller
{
     public function index(){
    	$lists = BankInformation::latest()->get();
        
        $apon =[];
         foreach($lists as $data){
           
                $depositAmount = BankCalculation::where('bank_information_id',$data->id)->where('type','deposit')->sum('amount');

                $widthdrawAmount = BankCalculation::where('bank_information_id',$data->id)->where('type','widthdraw')->sum('amount');

                $apon[] = array(
                    "id"=>$data->id,
                    "bank_name"=>$data->name,
                    "bank_account_no"=>$data->account_no,
                    "deposit_amount"=>$depositAmount,
                    "widthdraw_amount"=>$widthdrawAmount,
                );
           
        }

    	return view('back-end.bank.index',['lists'=>$apon]);
    }

    public function create(){
        $groups = BankInformation::all();
    	return view('back-end.bank.create',compact('groups'));
    }

    public function store(Request $request){
    	$info = new BankInformation();
        $info->name  = $request->name;
    	$info->account_no  = $request->account_no;
    	$info->save();
    	return redirect()->route('bank.index');
    }

     public function edit($id){
     	$info = BankInformation::findOrFail($id);
    	return view('back-end.bank.edit',compact('info'));
    }

    public function update(Request $request){
    	$info = BankInformation::findOrFail($request->id);
    	$info->name  = $request->name;
    	$info->account_no  = $request->account_no;
    	$info->save();
    	return redirect()->route('bank.index');
    }

      public function delete($id){
     	$info = BankInformation::findOrFail($id);
     	$info->delete();
    	return redirect()->route('bank.index');
    }

   public function details($id) {
    $bank_calculations = BankCalculation::where('bank_information_id', $id)
                                        ->whereIn('type', ['deposit', 'widthdraw'])
                                        ->get()
                                        ->groupBy('type');
                                        
    $bank_deposits = $bank_calculations->get('deposit', collect());
    $bank_widthdraws = $bank_calculations->get('widthdraw', collect());
    
    return view('back-end.bank.details', compact('bank_deposits', 'bank_widthdraws'));
}

}
