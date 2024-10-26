<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectorPayment extends Model
{
    use HasFactory;

    public function director(){
      return $this->belongsTo(Director::class,'director_id','id');
    }

}
