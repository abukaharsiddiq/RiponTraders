<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

     protected $fillable = ['customer_group_id','customer_id', 'purchase_no', 'total_amount', 'date'];

    public function customer(){
    	return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function payment(){
    	return $this->hasOne(PurchasePayment::class,'purchase_id','id');
    }

    public function purchase_details(){
    	return $this->hasMany(PurchaseDetails::class,'purchase_id','id');
    }

    public function customer_group(){
     return $this->belongsTo(CustomerGroup::class,'customer_group_id','id');
    }

}
