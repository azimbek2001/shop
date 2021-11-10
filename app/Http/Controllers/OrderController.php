<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderProd;
use App\Models\OrderCrossSells;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function executeOrders()
    {
         $collection=Order::where('status_id',2)->get();
         $orders=$collection->sortByDesc('id');

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
            'status'=>$order->status_id,
            'user_id'=>$order->user_id,
            'total'=>$order->total,
            'orderProd'=>$orderProd,
            'created_at'=>$order->created_at,
        ];
        }
        return response()->json($this->orderList);  
    }

    public function activeOrders()
    {
        $collection=Order::where('status_id',1)->get();
         $orders=$collection->sortByDesc('id');

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
            'status'=>$order->status_id,
            'user_id'=>$order->user_id,
            'total'=>$order->total,
            'orderProd'=>$orderProd,
            'created_at'=>$order->created_at,
        ];
        }
        return response()->json($this->orderList);  
    }

    public function index()
    {
        $orders=Order::orderBy('id', 'DESC')->get();
        if(!$orders){
            return response()->json([
                'status'=>false,
                'message'=>'Orders is null'
            ]);
        }
       
         $this->orderList=array();
        foreach ($orders as $order) {
            $this->orderList[]=[
            'id'=>$order->id,
            'name'=>$order->name,
            'surname'=>$order->surname,
            'phone'=>$order->phone,
            'address'=>$order->address,
            'status'=>$order->orderStatus->name,
            'user_id'=>$order->user_id,
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
        $order= Order::create([
        'name'=>$request->name,
        'surname'=>$request->surname,
        'address'=>$request->address,
        'phone'=>$request->phone,
        'user_id'=>$request->user_id,
        'comment'=>$request->comment,
        'total'=>$request->total,
        ]);

        foreach ($request->orderList as $orderList) {

            $list=OrderProd::create([
                'order_id'=>$order->id,
                'product_id'=>$orderList['product_id'],
                'quanity'=>$orderList['quanity'],
                'total'=>$orderList['total'],
            ]);
       
            foreach ($orderList['orderCross'] as $cross) {
                
                $orderCross=orderCrossSells::create([
                    'cross_sell_id'=>$cross['cross_sell_id'],
                    'price'=>$cross['price'],
                    'product_id'=>$list->id,
                ]);
            }
        }
        return $order;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order=Order::find($id);
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
            'orderList'=>$orderProd,
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
        $order=Order::find($id);
        if(!$order){
            return response()->json([
                'status'=>false,
                'message'=>'Order Not Found'
            ],404);
        }
        $order->status_id=2;
        $order->save();
        return $order;
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
        $order=Order::find($id);
        if(!$order){
            return response()->json([
                'status'=>false,
                'message'=>'Order Not Found'
            ],404);
        }
        $order->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Order Deleted',
        ]);
    }
}
