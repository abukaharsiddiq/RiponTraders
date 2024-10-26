<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FactoryGroup;

class FactoryGroupController extends Controller
{
    public function index(){
    	$lists = FactoryGroup::oldest()->get();
    	return view('back-end.factory.group.index',compact('lists'));
    }

    public function create(){
    	return view('back-end.factory.group.create');
    }

    public function store(Request $request){
    	$info = new FactoryGroup();
    	$info->name  = $request->name;
    	$info->save();
    	return redirect()->route('factory-group.index');
    }

     public function edit($id){
     	$info = FactoryGroup::findOrFail($id);
    	return view('back-end.factory.group.edit',compact('info'));
    }

    public function update(Request $request){
    	$info = FactoryGroup::findOrFail($request->id);
    	$info->name  = $request->name;
    	$info->save();
    	return redirect()->route('factory-group.index');
    }

      public function delete($id){
     	$info = FactoryGroup::findOrFail($id);
     	$info->delete();
    	return redirect()->route('factory-group.index');
    }
}
