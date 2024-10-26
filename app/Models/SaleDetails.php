<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetails extends Model
{
    use HasFactory;

    protected $fillable = ['customer_group_id','customer_id', 'order_no', 'order_id', 'product_id', 'quantity', 'unit_price', 'unit_total', 'date'];

    public function product(){
    	return $this->belongsTo(Product::class,'product_id','id');
    }

     public function customer(){
    	return $this->belongsTo(Customer::class,'customer_id','id');
    }

    //   public function customer_group(){
    // 	return $this->belongsTo(CustomerGroup::class,'customer_group_id','id');
    // }

}
