<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Product::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $path=$request->file('image')->store('product');
       $product= Product::create([
        'name'=>$request->name,
        'description'=>$request->description,
        'category_id'=>$request->category_id,
        'image'=>$path,
        'weight'=>$request->weight,
        'having'=>$request->having,
        'price'=>$request->price,
        'is_hit'=>$request->is_hit,
        'info'=>$request->info,

        'old_price'=>$request->old_price,
        'ingridients'=>$request->ingridients,
        ]);
        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::find($id);
        if(!$product){
            return response()->json([
                'status'=>false,
                'message'=>'Product Not Found'
            ],404);
        }
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $product=Product::find($id);
         if(!$product){
            return response()->json([
                'status'=>false,
                'message'=>'Product Not Found'
            ],404);
        }
        $product->name=$request->name;
        $product->description=$request->description;
        $product->category_id=$request->category_id;
        $product->weight=$request->weight;
        $product->having=$request->having;
        $product->price=$request->price;
        $product->is_hit=$request->is_hit;
        $product->info=$request->info;
        $product->old_price=$request->old_price;
        $product->ingridients=$request->ingridients;
        $product->save();
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
         if(!$product){
            return response()->json([
                'status'=>false,
                'message'=>'Product Not Found'
            ],404);
        }
        $product->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Product Deleted',
        ]);
    }
}
