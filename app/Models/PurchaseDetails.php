<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model
{
    use HasFactory;

    protected $fillable = ['customer_group_id','customer_id', 'purchase_no', 'purchase_id', 'product_id', 'quantity', 'unit_price', 'unit_total', 'date'];

    public function product(){
    	return $this->belongsTo(Product::class,'product_id','id');
    }

    public function customer(){
    	return $this->belongsTo(Customer::class,'customer_id','id');
    }

}
