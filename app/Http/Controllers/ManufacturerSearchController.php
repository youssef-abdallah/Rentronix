<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManufacturerSearchController extends Controller
{
    function index(Request $request){
        if (request()->ajax()){
            if(!empty($request->filter_gender)){
                $data=DB::table('products')
                    ->select('name')
                    ->where('name',$request->filter_product)
                    ->get();
            }
            else{
                $data=DB::table('products')
                    ->select('name')
                    ->get();
            }
            return $data;

        }

        $manufacturer_products=DB::table('products')
            ->select('name')
            ->groupBy('name')
            ->orderBy('name','ASC')
            ->get();
        return view('manufacturer_search',compact('manufacturer_products'));
    }
}
