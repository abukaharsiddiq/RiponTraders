<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Director;

class DirectorController extends Controller
{
    public function index(){
    	$lists = Director::latest()->get();
    	return view('back-end.director.index',compact('lists'));
    }

    public function create(){
        $groups = Director::all();
    	return view('back-end.director.create',compact('groups'));
    }

    public function store(Request $request){
    	$info = new Director();
        $info->name  = $request->name;
    	$info->phone  = $request->phone;
    	$info->address  = $request->address;
    	$info->save();
    	return redirect()->route('director.index');
    }

     public function edit($id){
     	$info = Director::findOrFail($id);
    	return view('back-end.director.edit',compact('info'));
    }

    public function update(Request $request){
    	$info = Director::findOrFail($request->id);
        $info->name  = $request->name;
    	$info->phone  = $request->phone;
    	$info->address  = $request->address;
    	$info->save();
    	return redirect()->route('director.index');
    }

      public function delete($id){
     	$info = Director::findOrFail($id);
     	$info->delete();
    	return redirect()->route('director.index');
    }
}
