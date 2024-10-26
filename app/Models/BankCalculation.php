<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankCalculation extends Model
{
    use HasFactory;

    public function bank(){
    	return $this->belongsTo(BankInformation::class,'bank_information_id','id');
    }
}
