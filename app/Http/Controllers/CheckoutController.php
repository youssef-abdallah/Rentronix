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
        $data = $request->json()->all();
        $order = new Order();
        $order->totalCost = 0;
        foreach (Cart::content() as $product)
        {
            $order->products()->attach($product->model, ['quantity' => $product->qty,
             'due_date' => '2021-01-01', 'type' => 'rent', '' => $product->model]);
            $order->totalCost += $product->model->price * $product->qty;
        }
        $order->paymentId = 1;
        $order->customer_id = Auth::id();
        $order->shipping_status = 'pending';
        $order->save();
        Session::flash('success', 'Your payment succeeded!');
        Cart::destroy();
        return response()->json(['success' => 'Payment Intent succeeded']);
    }
}
