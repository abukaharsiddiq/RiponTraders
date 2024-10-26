<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductGroup;

class ProductGroupController extends Controller
{
    public function index(){
    	$lists = ProductGroup::oldest()->get();
    	return view('back-end.product.group.index',compact('lists'));
    }

    public function create(){
    	return view('back-end.product.group.create');
    }

    public function store(Request $request){
    	$info = new ProductGroup();
    	$info->name  = $request->name;
    	$info->save();
    	return redirect()->route('product-group.index');
    }

     public function edit($id){
     	$info = ProductGroup::findOrFail($id);
    	return view('back-end.product.group.edit',compact('info'));
    }

    public function update(Request $request){
    	$info = ProductGroup::findOrFail($request->id);
    	$info->name  = $request->name;
    	$info->save();
    	return redirect()->route('product-group.index');
    }

      public function delete($id){
     	$info = ProductGroup::findOrFail($id);
     	$info->delete();
    	return redirect()->route('product-group.index');
    }
}
