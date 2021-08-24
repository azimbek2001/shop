<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return User::all();
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $user=User::find($id);
        if(!$user){
            return response()->json([
                'status'=>false,
                'message'=>'User Not Found'
            ],404);
        }
        $this->userList[]=[
            'id'=>$user->id,
            'name'=>$user->name,
            'surname'=>$user->surname,
            'phone'=>$user->phone,
            'email'=>$user->email,
            'created_at'=>$user->created_at,
            'comments'=>$user->comments,

        ];
        return response()->json($this->userList);
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
          $user=User::find($id);
        if(!$user){
            return response()->json([
                'status'=>false,
                'message'=>'User Not Found'
            ],404);
        }
        $user->name=$request->name;
        $user->surname=$request->surname;
        $user->phone=$request->phone;
        $user->email=$request->email;
        $user->save();
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $user=User::find($id);
        if(!$user){
            return response()->json([
                'status'=>false,
                'message'=>'User Not Found'
            ],404);
        }
        $user->delete();
        return response()->json([
            'status'=>true,
            'message'=>'User Deleted',
        ]);
    }
}
