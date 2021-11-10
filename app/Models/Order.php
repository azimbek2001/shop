<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
   protected $fillable = [
     'id',
     'name',
     'surname',  
     'phone',
     'address',
     'status_id',
     'user_id',
     'comment',
     'total',
       
    ];
      public function ordersProd(){
        return $this->hasMany(OrderProd::class,'order_id','id');
    }
     
    public function orderStatus(){
        return $this->hasOne(Status::class,'id','status_id');
    }
}
