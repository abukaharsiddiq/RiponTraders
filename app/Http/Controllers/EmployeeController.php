<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeGroup;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index(){
    	$lists = Employee::latest()->get();
    	return view('back-end.employee.index',compact('lists'));
    }

    public function create(){
        $groups = EmployeeGroup::all();
    	return view('back-end.employee.create',compact('groups'));
    }

    public function store(Request $request){
    	$info = new Employee();
    	$info->employee_group_id  = $request->employee_group_id;
        $info->name  = $request->name;
    	$info->father_name  = $request->father_name;
    	$info->phone  = $request->phone;
    	$info->address  = $request->address;
    	$info->salary  = $request->salary;
    	$info->save();
    	return redirect()->route('employee.index');
    }

     public function edit($id){
     	$info = Employee::findOrFail($id);
        $groups = EmployeeGroup::all();
    	return view('back-end.employee.edit',compact('info','groups'));
    }

    public function update(Request $request){
    	$info = Employee::findOrFail($request->id);
        $info->employee_group_id  = $request->employee_group_id;
    	$info->name  = $request->name;
    	$info->father_name  = $request->father_name;
    	$info->phone  = $request->phone;
    	$info->address  = $request->address;
    	$info->salary  = $request->salary;
    	$info->save();
    	return redirect()->route('employee.index');
    }

      public function delete($id){
     	$info = Employee::findOrFail($id);
     	$info->delete();
    	return redirect()->route('employee.index');
    }

}
