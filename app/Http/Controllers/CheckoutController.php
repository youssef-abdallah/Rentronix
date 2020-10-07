<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
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
        $order->delivery_date = Carbon::now()->add(3, 'day');
        $order->save();
        foreach (Cart::content() as $product)
        {
            $type = $product->options['type'];
            $hours = $product->options['hours'];
            $due_date = $order->delivery_date->add($hours, 'hour');
            $order->products()->attach($product->model, ['quantity' => $product->qty,
                'due_date' => $due_date, 'type' => $type,
                'seller_id' => $product->model->owner_id]);
            if ($type == 'rent')
            {
                $order->total_cost += $product->price * $product->qty * $hours ;
            } else 
            {
                $order->total_cost += $product->model->selling_price * $product->qty;
            }
            /*$manufacturer = User::findOrFail($product->model->owner_id);
            $manufacturer->manufacturerInfo->wallet = $manufacturer->manufacturerInfo->wallet + $order->total_cost;
            $manufacturer->manufacturerInfo->save();*/
        }
        $order->save();
        Cart::destroy();
        Cart::store(Auth::id());
        return response()->json(['success' => 'Checkout succeeded, your order is under processing']);
    }
}
