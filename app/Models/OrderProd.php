<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProd extends Model
{
    use HasFactory;
    protected $fillable = [
     'id',
     'order_id',
     'product_id',  
     'quanity',
     'total',
    ];
    public function orderProduct(){
        return $this->hasOne(Product::class,'id','product_id');
    }
    public function orderCrossSells(){
        return $this->hasMany(OrderCrossSells::class,'product_id','id');
    }
}
