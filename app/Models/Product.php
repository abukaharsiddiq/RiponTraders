<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function product_group(){
    	return $this->belongsTo(ProductGroup::class,'product_group_id','id');
    }

}
