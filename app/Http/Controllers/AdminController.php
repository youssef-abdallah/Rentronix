<?php

namespace App\Http\Controllers;

use App\Models\UserRequest;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function displayRequests()
    {
        $requests = UserRequest::all()->toJson(JSON_PRETTY_PRINT);
        return response($requests, 200);
    }

    /**
     * Admin approves user requests
     *
     * @param  \App\Models\UserRequest  $userRequest
     * @return \Illuminate\Http\Response
     */

    public function approve($userRequestId)
    {
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
