<?php

namespace App\Http\Controllers;

use  App\Models\Product;
use  App\Models\Category;
use  App\Models\Dostinfo;
use App\Models\CrossSell;
use App\Models\Payment;

use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    public function showProducts()
    {
    	$products=Product::all();
    	foreach ($products as $product) {
    		$this->productList[]=[
    		'id'=>$product->id,
    		'name'=>$product->name,
    		'price'=>$product->price,
    		'weight'=>$product->weight,
    		'description'=>$product->description,
    		'created_at'=>$product->created_at,
    		'is_hit'=>$product->is_hit,
    		'image'=>$product->image,
    		'old_price'=>$product->old_price ,
    		'category'=>$product->category,
    		'ingridients'=>$product->ingridientsin,
            'info'=>$product->info,

    	];
    	}
    	return response()->json($this->productList);
    }
    public function showProduct($id)
    {

    	$product=Product::find($id);
    	if(!$product){
    		return response()->json([
    			'status'=>false,
    			'message'=>'Product Not Found'
    		],404);
    	}
        $commentsList=[];
        foreach ($product->comments as $comment) {
             $commentsList[]=[
                'id'=>$comment->id,
                 'user_name'=>$comment->user->name,
                'user_surname'=>$comment->user->surname,
                'body'=>$comment->body,
                'created_at'=>$comment->created_at,
             ];
        }
    	$this->productList[]=[
    		'id'=>$product->id,
    		'name'=>$product->name,
    		'price'=>$product->price,
    		'weight'=>$product->weight,
    		'description'=>$product->description,
    		'created_at'=>$product->created_at,
    		'is_hit'=>$product->is_hit,
    		'image'=>$product->image,
    		'old_price'=>$product->old_price,
    		'ingridients'=>$product->ingridients,
    		'category'=>$product->category,
            'info'=>$product->info,    
            'comments'=>$commentsList,	
    	];
         
    	return response()->json($this->productList);
    }
    
    public function showCategories(){
    	$categories=Category::all();
        foreach ($categories as $category ) {
        $categoriesList[]=[
            'id'=>$category->id,
            'name'=>$category->name,
            'count'=>count($category->products),
        ];
            
        }
        
    	return response()->json([$categoriesList]);
    }
     public function showCategory($id){
        $category=Category::find($id);
        if(!$category){
            return response()->json([
                'status'=>false,
                'message'=>'Category Not Found'
            ],404);
        }
        $this->categoryList[]=[
            'id'=>$category->id,
            'name'=>$category->name,
            'products'=>$category->products,
        ];
        return response()->json($this->categoryList);
    }
    public function showDostInfos(){
    	$dostinfo=Dostinfo::all();
    	return response()->json($dostinfo);
    }
    public function showPayments(){
    	$payments=Payment::all();
    	return response()->json($payments);
    }
       public function showCrossSells(){
    	$seles=CrossSell::all();
    	return response()->json($seles);
    }
     public function showPopulars(){
        $populars=Product::where('is_hit',true)->get();
        return response()->json($populars);
    }
    
}
