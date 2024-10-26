<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashInTypeAssign extends Model
{
    use HasFactory;

    public function cash_in_type(){
    	return $this->belongsTo(CashInType::class,'cash_in_type_id','id');
    }

    public function customer_group(){
    	return $this->belongsTo(CustomerGroup::class,'customer_group_id','id');
    }

}
