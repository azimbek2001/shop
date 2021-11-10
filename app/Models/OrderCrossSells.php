<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCrossSells extends Model
{
    use HasFactory;
    protected $fillable = [
     'id',
     'product_id',
     'cross_sell_id',  
     'price',
     
    ];
     public function orderCross(){
        return $this->hasOne(CrossSell::class,'id','cross_sell_id');
    }
}
