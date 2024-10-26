<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CashInType;

class CashInTypeController extends Controller
{
    public function index(){
    	$lists = CashInType::latest()->get();
    	return view('back-end.cashintype.index',compact('lists'));
    }

    public function create(){
        $groups = CashInType::all();
    	return view('back-end.cashintype.create',compact('groups'));
    }

    public function store(Request $request){
    	$info = new CashInType();
        $info->name  = $request->name;
    	$info->save();
    	return redirect()->route('cashintype.index');
    }

     public function edit($id){
     	$info = CashInType::findOrFail($id);
    	return view('back-end.cashintype.edit',compact('info'));
    }

    public function update(Request $request){
    	$info = CashInType::findOrFail($request->id);
    	$info->name  = $request->name;
    	$info->save();
    	return redirect()->route('cashintype.index');
    }

      public function delete($id){
     	$info = CashInType::findOrFail($id);
     	$info->delete();
    	return redirect()->route('cashintype.index');
    }
}
