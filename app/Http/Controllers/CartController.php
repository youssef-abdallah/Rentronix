<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function store(Request $request)
    {
        // The Product class hasn't been added yet.
        $product = Product::find($request->id);
        $duplicate = Cart::search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });
        if ($duplicate->isNotEmpty())
        {
            return redirect()->route('products.index')->with('success', 'the product has already been added');
        }
        // Adding to cart
        Cart::add($product->id, $product->title, 1, $product->price, $request->type)
            ->associate('App\Models\Product');
        return redirect()->route('products.index')->with('success', 'the product has been added');
    }

    public function update(Request $request, $rowId)
    {
        $data = $request->json()->all();
        $validator = Validator::make($request->all(), [
            'qty' => 'required|numeric|between:1,5'
        ]);

        if ($validator->fails())
        {
            Session::flash('danger', 'The quantity of the product should not exceed 5.');
            return response()->json(['error' => 'Cart quantity has not been updated']);
        }
        Cart::update($rowId, $data['qty']);
        Session::flash('success', 'The quantity has been changed.');
        return response()->json(['success' => 'Cart quantity has been updated']);
    }

    public function destroy($rowid)
    {
        Cart::remove($rowid);
        return back()->with('success', 'The product has been deleted.');
    }
}
