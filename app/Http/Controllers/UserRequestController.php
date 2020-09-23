<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\UserRequest;
use App\Models\Product;
use App\Models\Subcategory;
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
    public function show($userRequestId)
    {
        $userRequest = UserRequest::findOrFail($userRequestId);
        return response($userRequest, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserRequest  $userRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userRequestId)
    {
        $userRequest = UserRequest::findOrFail($userRequestId);
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
    public function destroy($userRequest)
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

     public function approve($userRequestId)
     {
        // ToDo:   Admin authorization
        $userRequest = UserRequest::findOrFail($userRequestId);
        if ($userRequest->approved) {
            return response()->json([
                'message' => 'request was already approved.'
            ], 200);
        }
        $product = new Product();
        $product->name = $userRequest->product_name;
        $product->available_stock = $userRequest->quantity;
        $product->product_overview = $userRequest->description;
        $product->available_for = $userRequest->type == 'loan' ? 'rent' : 'buy';
        $product->rental_price = $userRequest->price_per_hour;
        $product->selling_price = $userRequest->price;
        $product->image_url = $userRequest->image;
        $product->datasheet_url = $userRequest->datasheet;
        $product->owner_id = $userRequest->user_id;
        $subcategory = Subcategory::where('title', $userRequest->subcategory_title)->first();
        if (is_null($subcategory))
        {
            $category = Category::where('title', $userRequest->category_title)->first();
            if (is_null($category))
            {
                $category = new Category();
                $category->title = $userRequest->category_title;
                $category->save();
            }
            $subcategory = new Subcategory();
            $subcategory->title = $userRequest->subcategory_title;
            $subcategory->category_id = $category->id;
            $subcategory->description = $userRequest->subcategory_description;
            $subcategory->save();
        }
        $product->subcategory_id = $subcategory->id;
        $userRequest->approved = true;
        $userRequest->save();
        $product->save();
        return response()->json([
            'message' => 'request approved and product added.'
        ], 200);
     }
}
