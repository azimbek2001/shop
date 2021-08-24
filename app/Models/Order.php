<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
      public function ordersProd(){
        return $this->hasMany(OrderProd::class,'order_id','id');
    }
     public function orderCrossSells(){
        return $this->hasMany(OrderCrossSells::class,'id','order_id');
    }
}
