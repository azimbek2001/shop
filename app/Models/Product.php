<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'description',
        'views',
        'category_id',
        'image',
        'weight',
        'having',
        'price',
        'is_hit',
        'created_at',
        'specifications',
        'old_price',
    ];
    public function category(){
    	return $this->hasOne(Category::class,'id','category_id');
    }
      public function comments(){
    	return $this->hasMany(Comment::class,'product_id','id');
    }
}

