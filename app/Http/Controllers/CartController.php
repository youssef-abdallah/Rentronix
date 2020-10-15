<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        // Restoring the cart
        Cart::restore(Auth::id());
        $data = Cart::content()->toJson(JSON_PRETTY_PRINT);
        return response($data, 200);
    }

    public function store(Request $request)
    {
        $product = Product::find($request->id);

        // Restoring the cart
        Cart::restore(Auth::id());

        $duplicate = Cart::search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });
        if ($duplicate->isNotEmpty())
        {
            return response()->json(['message' => 'The products is already added to the cart'], 201);
        }
        // Adding to cart
        $type = $request->type;
        $renting_hours = 0;
        if ($request->renting_hours) $renting_hours = $request->renting_hours;
        Cart::add($product->id, $product->name, 1, $type == 'buy' ? 
            $product->selling_price : $product->rental_price, ['hours' => $renting_hours,
             'type' => $type])
            ->associate('App\Models\Product');

        // Storing the cart
        Cart::store(Auth::id());
        $rowId = Cart::content()->last()->rowId;

        return response()->json([
            'message' => 'The product has been added to the cart',
            'rowId' => $rowId
        ], 201);
    }

    public function update(Request $request, $rowId)
    {
        // Restoring the cart
        Cart::restore(Auth::id());
        $data = $request->json()->all();
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,5',
            'hours' => 'required',
        ]);

        if ($validator->fails())
        {
            Session::flash('danger', 'The quantity of the product should not exceed 5.');
            return response()->json(['error' => 'Cart quantity has not been updated']);
        }
        Cart::update($rowId, ['qty'=>$request->quantity , 'options'=>['hours'=>$request->hours]]);
        // Storing the cart
        Cart::store(Auth::id());
        Session::flash('success', 'The quantity has been changed.');
        return response()->json(['success' => 'Cart quantity has been updated']);
    }

    public function destroy($rowid)
    {
        // Restoring the cart
        Cart::restore(Auth::id());
        Cart::remove($rowid);
        // Storing the cart
        Cart::store(Auth::id());
        return response()->json(['success' => 'The product has been removed from cart']);
    }
}
