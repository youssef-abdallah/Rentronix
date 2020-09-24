<?php

namespace App\Http\Controllers;

//use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NumbersController extends Controller
{

    public function numberOfOrders(){
        $id=Auth::id();
        $yourOrders = DB::table('orders')->where('seller_id', $id)->get();
        $numberOfOrders=$yourOrders->count();
        return response()->json($numberOfOrders,200);
    }
    public function mostOrderedItem(){
        $id=Auth::id();
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
    public function monthProfit(){
        $id=Auth::id();
        $now=Carbon::now();
        $thisMonth=$now->format('m');
        $orders= DB::table('orders')
            ->select('total_cost')
            ->where('seller_id', $id)
            ->whereMonth('created_at', '=', $thisMonth)
            ->get();
        $profit=$orders->sum('total_cost');
        return response()->json($profit,200);

    }
    public function mostFavouriteListedItem(){
        $id=Auth::id();
        $product_name=DB::table('favourite_lists')
            ->join('products','products.id','=','favourite_lists.product_id')
            ->select('products.name')
            ->where('products.owner_id',$id)
            ->groupBy('products.name')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(1)
            ->get();
        return response()->json($product_name,200);
    }

    public function productFavouriteList($product_id){
        $id=Auth::id();
        $fav=DB::table('favourite_lists')
            ->join('products','products.id','=','favourite_lists.product_id')
            ->where('products.owner_id',$id)
            ->where('products.id',$product_id)
            ->get();
        $numberOfFav=$fav->count();
        return response()->json($numberOfFav,200);

    }
    public function productSold($product_id){
        $id=Auth::id();
        $orders=DB::table('orders')
            ->join('order_details','orders.id','=','order_details.order_id')
            ->join('products','order_details.product_id','=','products.id')
            ->where('orders.seller_id', '=', $id)
            ->where('products.id',$product_id)
            ->where('order_details.type','buy')
            ->get();
        $numberOfOrders=$orders->count();
        return response()->json($numberOfOrders,200);

    }
    public function productRented($product_id){
        $id=Auth::id();
        $orders=DB::table('orders')
            ->join('order_details','orders.id','=','order_details.order_id')
            ->join('products','order_details.product_id','=','products.id')
            ->where('orders.seller_id', '=', $id)
            ->where('products.id',$product_id)
            ->where('order_details.type','rent')
            ->get();
        $numberOfOrders=$orders->count();
        return response()->json($numberOfOrders,200);


    }
    public function productProfit($product_id){
        $id=Auth::id();
        $orders= DB::table('orders')
            ->join('order_details','orders.id','=','order_details.order_id')
            ->select('total_cost')
            ->where('seller_id', $id)
            ->where('order_details.product_id',$product_id)
            ->get();
        $profit=$orders->sum('total_cost');
        return response()->json($profit,200);
    }


}
