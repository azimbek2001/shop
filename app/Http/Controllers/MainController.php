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
    	$products=Product::orderBy('id', 'DESC')->get();
    	foreach ($products as $product) {
    		$this->productList[]=[
    		'id'=>$product->id,
    		'name'=>$product->name,
    		'price'=>$product->price,
    		'weight'=>$product->weight,
    		'image'=>$product->image,
    		'old_price'=>$product->old_price ,
    		'category'=>$product->category,
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
        $comments=$product->comments;
        $comments=$comments->sortByDesc('id');
        foreach ($comments as $comment) {
             $commentsList[]=[
                'id'=>$comment->id,
                'user_name'=>$comment->user->name,
                'user_surname'=>$comment->user->surname,
                'body'=>$comment->body,
             ];
        }
    	$this->productList=[
    		'id'=>$product->id,
    		'name'=>$product->name,
    		'price'=>$product->price,
    		'weight'=>$product->weight,
    		'description'=>$product->description,
    		'image'=>$product->image,
    		'old_price'=>$product->old_price,
    		'ingridients'=>$product->ingridients,		
            'info'=>$product->info,    
            'comments'=>$commentsList,	
    	];
         
    	return response()->json($this->productList);
    }
    
    public function showCategories(){
    	$categories=Category::all();
        $populars=Product::where('is_hit',true)->get();
         $categoriesList[]=[
            'id'=>0,
               'name'=>'Популярное', 
               'count'=>count($populars)
         ];
        foreach ($categories as $category ) {
        $categoriesList[]=[
            'id'=>$category->id,
            'name'=>$category->name,
            'count'=>count($category->products),
        ];
            
        }

        
    	return response()->json($categoriesList);
    }
     public function showCategory($id){
        $productList=[];
        if($id==0){
            $populars=Product::where('is_hit',true)->get();
            $populars=$populars->sortByDesc('id');
             foreach ($populars as $product) {
            $productList[]=[
            'id'=>$product->id,
            'name'=>$product->name,
            'price'=>$product->price,
            'weight'=>$product->weight,
            'image'=>$product->image,
            
            'old_price'=>$product->old_price ,
            'info'=>$product->info,
        ];
        }
              $popularsList=[
            'id'=>0,
            'name'=>'Популярное ',
            'products'=>$productList,
        ];
              return response()->json($popularsList);
        }
       
        $category=Category::find($id);
       
        if(!$category){
            return response()->json([
                'status'=>false,
                'message'=>'Category Not Found'
            ],404);
        }
        $products=$category->products;
        $products=$products->sortByDesc('id');
         foreach ($products as $product) {
            $productList[]=[
            'id'=>$product->id,
            'name'=>$product->name,
            'price'=>$product->price,
            'weight'=>$product->weight,
            'image'=>$product->image,
            'old_price'=>$product->old_price ,
            'info'=>$product->info,
        ];
        }
        $this->categoryList=[
            'id'=>$category->id,
            'name'=>$category->name,
            'products'=>$productList,
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
     $crossSells=CrossSell::orderBy('id', 'DESC')->get();
        if(!$crossSells){
            return response()->json([
                'status'=>false,
                'message'=>'Not found Cross Sell'
            ]);
        }

        foreach ($crossSells as $crossSell) {
            $this->crossList[]=[
            'id'=>$crossSell->id,
            'name'=>$crossSell->name,
            'price'=>$crossSell->price,
           
        ];
        }
        return response()->json($this->crossList);
    }

    
     public function showPopulars(){
        $populars=Product::where('is_hit',true)->get();

        return response()->json($populars);
    }
    
}
