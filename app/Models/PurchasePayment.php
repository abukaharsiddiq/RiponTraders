<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasePayment extends Model
{
    use HasFactory;

    protected $fillable = ['customer_group_id','customer_id', 'purchase_id', 'purchase_no', 'paid_amount', 'due_amount', 'payment_type', 'date'];

    public function customer(){
    	return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function customer_group(){
    	return $this->belongsTo(CustomerGroup::class,'customer_group_id','id');
    }

}
