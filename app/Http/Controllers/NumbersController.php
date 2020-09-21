<?php

namespace App\Http\Controllers;

//use App\Models\Order;
use Illuminate\Support\Facades\DB;

class NumbersController extends Controller
{

    public function NumberOfOrders($id){
        $yourOrders = DB::table('orders')->where('seller_id', $id)->get();
        return response()->json($yourOrders,200);
    }
    public function MostOrderedItem($id){

        $product_name=DB::table('orders')
            ->join('order_details','orders.id','=','order_details.order_id')
            ->join('products','order_details.product_id','=','products.id')
            ->select('products.name')
            ->where('orders.seller_id', '=', $id)
            ->groupBy('products.name')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(1)
            ->get();
        return response()->json($product_name,200);
    }


}
