<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashOut extends Model
{
    use HasFactory;

     protected $fillable =['payment_type','bank_information_id','cash_in_type_id','customer_group_id','customer_id','reason','amount','month_year','date'];

    public function cash_in_type(){
    	return $this->belongsTo(CashInType::class,'cash_in_type_id','id');
    }

    public function customer_group(){
    	return $this->belongsTo(CustomerGroup::class,'customer_group_id','id');
    }

    public function customer(){
    	return $this->belongsTo(Customer::class,'customer_id','id');
    }

     public function bank_information(){
        return $this->belongsTo(BankInformation::class,'bank_information_id','id');
    }

}
