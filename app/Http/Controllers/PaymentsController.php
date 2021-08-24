<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
          return Payment::all();
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
         $payment= Payment::create([
        'name'=>$request->name,
        'description'=>$request->description,
        'bill'=>$request->bil,
        ]);
        return $payment;
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         
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
         $payment=Payment::find($id);
         if(!$payment){
            return response()->json([
                'status'=>false,
                'message'=>'payment Not Found'
            ],404);
        }
        $payment->name=$request->name;
        $payment->description=$request->name;
        $payment->bill=$request->name;

          $payment->save();
       
        return $payment;
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
        $payment=Payment::find($id);
         if(!$payment){
            return response()->json([
                'status'=>false,
                'message'=>'payment Not Found'
            ],404);
        }

        $payment->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Payment Deleted',
        ]);
    }
}
