<?php

namespace App\Http\Controllers;
use App\Models\CrossSell;
use Illuminate\Http\Request;

class CrossController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $crossSell=CrossSell::all();
        if(!$crossSell){
            return response()->json([
                'status'=>false,
                'message'=>'Not found Cross Sell'
            ]);
        }
        return  $crossSell;
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
         $crossSell= CrossSell::create([
        'name'=>$request->name,
        'price'=>$request->price
        ]);
        return $category;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $crossSell=CrossSell::find($id);
        if(!$crossSell){
            return response()->json([
                'status'=>false,
                'message'=>'cross Sell Not Found'
            ],404);
        }
        return $crossSell;
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
         $crossSell=CrossSell::find($id);
        if(!$crossSell){
            return response()->json([
                'status'=>false,
                'message'=>'cross Sell Not Found'
            ],404);
        }
          $crossSell->name=$request->name;
          $crossSell->price=$request->price;

          $crossSell->save();
        return $crossSell;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $crossSell=CrossSell::find($id);
        if(!$crossSell){
            return response()->json([
                'status'=>false,
                'message'=>'Cross Sell Not Found'
            ],404);
        }
        $crossSell->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Cross Sell Deleted',
        ]);
    }
}
