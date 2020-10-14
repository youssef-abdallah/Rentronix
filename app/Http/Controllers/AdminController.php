<?php

namespace App\Http\Controllers;

use App\Models\UserRequest;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewAd;
use App\Models\Complaint;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRequests()
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

    public function destroyRequest(UserRequest $request)
    {
        $request->delete();
        return response()->json([
            'message' => 'request has been successfully deleted.'
        ], 200);
    }

    public function showProducts()
    {
        $products = Product::all()->toJson(JSON_PRETTY_PRINT);
        return response($products, 200);
    }

    public function destroyProduct(Product $product)
    {
        $product->delete();
        return response()->json([
            'message' => 'product has been successfully deleted.'
        ], 200);
    }

    public function showOrders()
    {
        $orders = Order::with('products')->get()->toJson(JSON_PRETTY_PRINT);
        return response($orders, 200);
    }

    public function destroyOrder(Order $order)
    {
        $customer = User::find($order->customer_id);
        $customer->customerInfo->credit += $order->total_cost;
        $customer->customerInfo->save();
        $order->delete();
        return response()->json([
            'message' => 'order has been successfully deleted.'
        ], 200);
    }

    /**
     * Updates the current order stage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function updateOrderStatus(Order $order)
    {
        // ToDo put request in api.php
        $shipping_status =  $order->shipping_status;
        if ($shipping_status == 'delivered') {
            return response()->json([
                'message' => 'order has been already delivered.'
            ], 200);
        }
        $order->updateStatus($shipping_status);
        $customer_email = User::find($order->customer_id)->email;
        if ($shipping_status == 'delivered')
        {
            Mail::to($customer_email)->send(new NewAd());
        }
        return response()->json([
            'message' => 'order status has been updated.'
        ], 200);
    }

    public function showUsers()
    {
        $users = User::with('manufacturerInfo')->with('customerInfo')->get()->toJson(JSON_PRETTY_PRINT);
        return response($users, 200);
    }

    public function showComplaints()
    {
        $complaints = Complaint::all()->toJson(JSON_PRETTY_PRINT);
        return response($complaints, 200);
    }

    public function destroyComplaint(Complaint $complaint)
    {
        $complaint->delete();
        return response()->json([
            'message' => 'complaint has been successfully deleted.'
        ], 200);
    }
}
