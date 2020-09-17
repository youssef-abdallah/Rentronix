<?php

namespace App\Http\Controllers;

use App\Models\UserRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class UserRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = UserRequest::all()->toJson(JSON_PRETTY_PRINT);
        return response($requests, 200);
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
        $this->validate($request, [
            'image' => 'image|max:1024',
            'datasheet' => 'mimes:pdf|max:10000'
        ]);
        $userRequest = UserRequest::create($data);
        $imageFileName = 'product_'.strval($userRequest->id).'.png';
        $file = $request->file('image')->move(public_path('images'), $imageFileName);
        $imageFileUrl = url('public/images/'.$imageFileName);
        $userRequest->image = $imageFileUrl;
        $datasheetFileName = 'datasheet_'.strval($userRequest->id).'.pdf';
        $file = $request->file('datasheet')->move(public_path('datasheets'), $datasheetFileName);
        $datasheetFileUrl = url('public/images/'.$datasheetFileName);
        $userRequest->datasheet = $datasheetFileUrl;
        $userRequest->save();
        return response()->json([
            'message' => 'request record created'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserRequest  $userRequest
     * @return \Illuminate\Http\Response
     */
    public function show(UserRequest $userRequest)
    {
        return response($userRequest, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserRequest  $userRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserRequest $userRequest)
    {
        $userRequest->update($request->all());
        return response()->json([
            'message' => 'request record updated'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserRequest  $userRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRequest $userRequest)
    {
        UserRequest::destroy($userRequest);
        return response()->json([
            'message' => 'request record deleted'
        ], 200);
    }

    /**
     * Admin approves user requests
     *
     * @param  \App\Models\UserRequest  $userRequest
     * @return \Illuminate\Http\Response
     */

     public function approve(UserRequest $userRequest)
     {
        // ToDo:   Admin authorization
        if ($userRequest->approved) {
            return response()->json([
                'message' => 'request was already approved.'
            ], 200);
        }
        $product = new Product();
        $product->name = $userRequest->product_name;
        $product->quantity = $userRequest->quantity;
        $product->product_overview = $userRequest->description;
        $product->available_for = $userRequest->type == 'loan' ? 'rent' : 'buy';
        $product->rental_price = $userRequest->price_per_hour;
        $product->selling_price = $userRequest->price;
        $product->image_url = $userRequest->image;
        $product->datasheet_url = $userRequest->datasheet;
        $product->manufacturer_id = $userRequest->user_id;
        $userRequest->save();
        $product->save();
        $userRequest->approved = true;
        return response()->json([
            'message' => 'request approved and product added.'
        ], 200);
     }
}
