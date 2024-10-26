<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeGroup;

class EmployeeGroupController extends Controller
{
    public function index(){
    	$lists = EmployeeGroup::oldest()->get();
    	return view('back-end.employee.group.index',compact('lists'));
    }

    public function create(){
    	return view('back-end.employee.group.create');
    }

    public function store(Request $request){
    	$info = new EmployeeGroup();
    	$info->name  = $request->name;
    	$info->save();
    	return redirect()->route('employee-group.index');
    }

     public function edit($id){
     	$info = EmployeeGroup::findOrFail($id);
    	return view('back-end.employee.group.edit',compact('info'));
    }

    public function update(Request $request){
    	$info = EmployeeGroup::findOrFail($request->id);
    	$info->name  = $request->name;
    	$info->save();
    	return redirect()->route('employee-group.index');
    }

      public function delete($id){
     	$info = EmployeeGroup::findOrFail($id);
     	$info->delete();
    	return redirect()->route('employee-group.index');
    }
}
