<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $comments=Comment::orderBy('id', 'DESC')->get();
        $commentList=array();
        foreach ($comments as $comment) {
            $this->commentList[]=[
            'id'=>$comment->id,
            'body'=>$comment->body,
            'user'=>$comment->user->name . " " . $comment->user->surname,
            
            'product'=>$comment->product->name,
        ];
        }
        return response()->json($this->commentList);
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
        $comments= \App\Models\Comment::create([      
        'body'=>$request->body,
        'user_id'=>$request->user_id,
        'product_id'=>$request->product_id,
        ]);
        return $comments;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment=Comment::find($id);
        if(!$comment){
            return response()->json([
                'status'=>false,
                'message'=>'Сomment Not Found'
            ],404);
        }
        $this->commentList=[
            'id'=>$comment->id,
            'body'=>$comment->body,
              'user'=>$comment->user->name . " " . $comment->user->surname,
            
            'product'=>$comment->product->name,
            
        ];
        return response()->json($this->commentList);
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
         $comment=Comment::find($id);
        if(!$comment){
            return response()->json([
                'status'=>false,
                'message'=>'Сomment Not Found'
            ],404);
        }

        $comment->body=$request->body;
        $comment->user_id=$request->user_id;
        $comment->product_id=$request->product_id;
        $comment->save();
        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $comment=Comment::find($id);
        if(!$comment){
            return response()->json([
                'status'=>false,
                'message'=>'Сomment Not Found'
            ],404);
        }
         $comment->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Comment Deleted',
        ]);
    }
}
