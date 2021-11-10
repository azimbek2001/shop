<?php

namespace App\Http\Controllers\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OrderCrossSells;
use App\Models\Order;
use App\Models\OrderProd;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $user=auth()->user();
         $orders=$user->orders;
        if(!$orders){
            return response()->json([
                'status'=>false,
                'message'=>'Orders is null'
            ]);
        }
       
        $this->orderList=array();
        foreach ($orders as $order) {
      
         $orderProd=array();
            foreach ($order->ordersProd as $product) {
                $orderCross=array();
                foreach ($product->orderCrossSells as $cross) {
                $orderCross[]=[
                'id'=>$cross->id,
                'name'=>$cross->orderCross->name,
                'price'=>$cross->orderCross->price,
                ];
            }
                $orderProd[]=[
                'id'=>$product->id,
                'name'=>$product->orderProduct->name,
                'price'=>$product->orderProduct->price,
                'quanity'=>$product->quanity,
                'total'=>$product->total,
                'crossSells'=> $orderCross,  
            ];
        }
        
            $this->orderList[]=[
            'id'=>$order->id,
            'name'=>$order->name,
            'surname'=>$order->surname,
            'phone'=>$order->phone,
            'address'=>$order->address,
            'status'=>$order->orderStatus->name,
            'orderProd'=>$orderProd,
            'user_id'=>$order->user_id,
            'comment'=>$order->comment,
            'total'=>$order->total,
            'created_at'=>$order->created_at,
           
        ];
        }
        return response()->json($this->orderList);
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
        //
         $user=auth()->user();
        $order=Order::find($id);
        if($order->user_id!=$user->id){
return response()->json([
                'status'=>false,
                'message'=>'Order Not Found'
            ],404);

        }
        if(!$order){
            return response()->json([
                'status'=>false,
                'message'=>'Order Not Found'
            ],404);
        }
        $orderProd=array();
        $orderCross=array();
            foreach ($order->ordersProd as $product) {
                foreach ($product->orderCrossSells as $cross) {
                $orderCross[]=[
                'id'=>$cross->id,
                'name'=>$cross->orderCross->name,
                'price'=>$cross->orderCross->price,
                ];
            }
                $orderProd[]=[
                'id'=>$product->id,
                'name'=>$product->orderProduct->name,
                'price'=>$product->orderProduct->price,
                'quanity'=>$product->quanity,
                'total'=>$product->total,
                'crossSells'=> $orderCross,  
            ];
        }
            $this->orderList=[
            'id'=>$order->id,
            'name'=>$order->name,
            'surname'=>$order->surname,
            'phone'=>$order->phone,
            'address'=>$order->address,
            'status'=>$order->orderStatus->name,
            'orderProd'=>$orderProd,
            'user_id'=>$order->user_id,
            'comment'=>$order->comment,
            'total'=>$order->total,
            'created_at'=>$order->created_at,
        ];
        
        return response()->json($this->orderList);
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
    }
}
