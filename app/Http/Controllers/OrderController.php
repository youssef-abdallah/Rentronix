<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\CustomerInfo;
use App\Models\User;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all()->toJson(JSON_PRETTY_PRINT);
        return response($orders, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return order create-form view
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Order::create($data);

        /*$customer = User::findOrFail($request->customer_id);
        $customer->customerInfo->wallet -= min($request->total_cost , $customer->customerInfo->wallet);
        $customer->customerInfo->save();*/
        
        return response()->json([
            'message' => 'order record created'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
        return response($order, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //return order edit-form view
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
        $order->update($request->all());
        return response()->json([
            'message' => 'order record updated'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        
        /*$customer = User::findOrFail($order->customer_id);
        $customer->customerInfo->wallet += $order->total_cost;
        $customer->customerInfo->save();*/

        Order::destroy($order->id);
        return response()->json([
            'message' => 'order record deleted'
        ], 200);
    }

}
