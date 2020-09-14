<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
    }

    public function store(Request $request)
    {
        $data = $request->json()->all();
        $order = new Order();
        foreach (Cart::content() as $product)
        {
            // ToDo: attach to the order detail
            $order->roles()->attach($product, ['quantity' => 1,
             'due_date' => '2021-01-01', 'type' => 'rent']);
            // Filling all the order details
        }
        // ToDo: Filling the order fields.

        $order->save();
        Session::flash('success', 'Your payment succeeded!');
        Cart::destroy();
        return response()->json(['success' => 'Payment Intent succeeded']);
    }
}
