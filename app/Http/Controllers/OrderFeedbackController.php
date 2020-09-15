<?php

namespace App\Http\Controllers;

use App\Models\OrderFeedback;
use Illuminate\Http\Request;

class OrderFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ordersFeedback = OrderFeedback::all()->toJson(JSON_PRETTY_PRINT);
        return response($ordersFeedback, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return orderfeedback create-form view
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
        $data = $request->all();
        OrderFeedback::create($data);
        return response()->json([
            'message' => 'order feedback record created'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderFeedback  $orderFeedback
     * @return \Illuminate\Http\Response
     */
    public function show(OrderFeedback $orderFeedback)
    {
        //
        return response($orderFeedback, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderFeedback  $orderFeedback
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderFeedback $orderFeedback)
    {
        //return orderfeedback edit-form view
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderFeedback  $orderFeedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderFeedback $orderFeedback)
    {
        //
        $orderFeedback->update($request->all());
        return response()->json([
            'message' => 'order feedback record updated'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderFeedback  $orderFeedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderFeedback $orderFeedback)
    {
        //
        OrderFeedback::destroy($orderFeedback);
        return response()->json([
            'message' => 'order feedback record deleted'
        ], 200);
    }
}
