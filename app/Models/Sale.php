<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['customer_group_id','customer_id', 'order_no', 'total_amount', 'date'];

    public function customer(){
    	return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function payment(){
    	return $this->hasOne(Payment::class,'order_id','id');
    }

    public function sale_details(){
    	return $this->hasMany(SaleDetails::class,'order_id','id');
    }

    public function customer_group(){
     return $this->belongsTo(CustomerGroup::class,'customer_group_id','id');
    }
}
