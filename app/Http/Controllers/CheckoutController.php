<?php

namespace App\Http\Controllers;

use App\Models\ManufacturerInfo;
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
            $cost = 0;
            if ($type == 'rent')
            {
                $cost = $product->price * $product->qty * $hours;
                $order->total_cost += $cost;
            } else 
            {
                $cost = $product->model->selling_price * $product->qty;
                $order->total_cost += $cost;
            }
            $manufacturer = User::findOrFail($product->model->owner_id);
            $info = $manufacturer->manufacturerInfo ?: new ManufacturerInfo();
            $info->profit = $info->profit + $cost;
            $info->user_id = $manufacturer->id;
            $info->save();
        }
        $order->save();
        Cart::destroy();
        Cart::store(Auth::id());
        return response()->json(['success' => 'Checkout succeeded, your order is under processing']);
    }
}
