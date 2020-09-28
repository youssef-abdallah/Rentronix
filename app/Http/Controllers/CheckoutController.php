<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
    }

    public function store(Request $request)
    {
        Cart::restore(Auth::id());
        $order = new Order();
        $order->total_cost = 0;
        $order->payment_id = 1;
        $order->customer_id = Auth::id();
        $order->shipping_status = 'pending';
        $order->delivery_date = '2021-01-01';
        $order->save();
        foreach (Cart::content() as $product)
        {
            $order->products()->attach($product->model, ['quantity' => $product->qty,
                'due_date' => '2021-01-01', 'type' => 'rent',
                'seller_id' => $product->model->owner_id]);
            // dd($product->model);
            $order->total_cost += $product->model->selling_price * $product->qty;
        }
        $order->save();
        Session::flash('success', 'Your payment succeeded!');
        Cart::destroy();
        Cart::store(Auth::id());
        return response()->json(['success' => 'Payment Intent succeeded']);
    }
}
