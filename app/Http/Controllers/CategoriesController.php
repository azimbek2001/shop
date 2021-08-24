<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
           return Category::all();
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
         $category= Category::create([
        'name'=>$request->name,
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
         $category=Category::find($id);
        if(!$category){
            return response()->json([
                'status'=>false,
                'message'=>'Category Not Found'
            ],404);
        }
        return $category;
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
      $category=Category::find($id);
         if(!$category){
            return response()->json([
                'status'=>false,
                'message'=>'Category Not Found'
            ],404);
        }
        $category->name=$request->name;
          $category->save();
        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $category=Category::find($id);
         if(!$category){
            return response()->json([
                'status'=>false,
                'message'=>'Category Not Found'
            ],404);
        }
        $category->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Category Deleted',
        ]);
    
    }
}
