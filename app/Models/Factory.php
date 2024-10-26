<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factory extends Model
{
    use HasFactory;

    public function factory_group(){
    	return $this->belongsTo(FactoryGroup::class,'factory_group_id','id');
    }
}
