<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductGroup;
use App\Models\Product;
use Carbon\Carbon;

class ProductController extends Controller
{
     public function index(){
    	$lists = Product::latest()->get();
    	return view('back-end.product.index',compact('lists'));
    }

    public function create(){
        $groups = ProductGroup::all();
    	return view('back-end.product.create',compact('groups'));
    }

    public function store(Request $request){
    	$info = new Product();
    	$info->product_group_id  = $request->product_group_id;
        $info->name  = $request->name;
    	 if($request->hasFile('image')){
            $path = public_path('back-end/product/');
            $file = $request->image;
            $fileName = time().'.'.$file->getClientOriginalName();
            $file->move($path,$fileName);
            $info->image = $fileName; 
        }
    	$info->barcode  = $request->barcode;
    	$info->save();
    	return redirect()->route('product.index');
    }

     public function edit($id){
     	$info = Product::findOrFail($id);
        $groups = ProductGroup::all();
    	return view('back-end.product.edit',compact('info','groups'));
    }

    public function update(Request $request){
    	$info = Product::findOrFail($request->id);
        $info->product_group_id  = $request->product_group_id;
    	$info->name  = $request->name;
    	if($request->hasfile('image')){
            $destination = public_path('back-end/product/').$info->image;
            if(file_exists($destination)){
                @unlink($destination);
            }
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $fileName = time().'.'.$name;
            $file->move(public_path('back-end/product'),$fileName);
            $info->image = $fileName;
        }
    	$info->barcode  = $request->barcode;
    	$info->save();
    	return redirect()->route('product.index');
    }

      public function delete($id){
     	$info = Product::findOrFail($id);
     	 if($info){
           @unlink(public_path('back-end/product/'.$info->image));
           $info->delete(); 
        }
     	$info->delete();
    	return redirect()->route('product.index');
    }


}
