<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function customer_group(){
    	return $this->belongsTo(CustomerGroup::class,'customer_group_id','id');
    }
}
