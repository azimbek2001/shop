<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dostinfo;

class DostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
               return Dostinfo::all();
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
       $dost= Dostinfo::create([
        'name'=>$request->name,
        'num'=>$request->num,
        ]);
        return $dost;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
         $dost=Dostinfo::find($id);
        if(!$dost){
            return response()->json([
                'status'=>false,
                'message'=>'dost Not Found'
            ],404);
        }
        return $dost;
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
       $dost=Dostinfo::find($id);
         if(!$dost){
            return response()->json([
                'status'=>false,
                'message'=>'dost Not Found'
            ],404);
        }
        $dost->name=$request->name;
        $dost->num=$request->num;

          $dost->save();
        return $dost;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $dost=Dostinfo::find($id);
         if(!$dost){
            return response()->json([
                'status'=>false,
                'message'=>'dost Not Found'
            ],404);
        }
          $dost->delete();
        return response()->json([
            'status'=>true,
            'message'=>'dost Deleted',
        ]);
    }
}
