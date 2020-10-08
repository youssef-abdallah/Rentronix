<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FavouriteList;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class FavouriteListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category,Subcategory $subcategory, $product_id)
    {
        $product = Product::find($product_id);
        if (count($product->favouriteList)<1)
        {
            return response()->json('no comments for this product ',404);
        }
        else
        {
            return response( $product->favouriteList, 200);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FavouriteList  $FavouriteList
     * @return \Illuminate\Http\Response
     */
    public function show(FavouriteList $favouriteList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FavouriteList  $FavouriteList
     * @return \Illuminate\Http\Response
     */
    public function edit(FavouriteList $favouriteList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FavouriteList  $FavouriteList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FavouriteList $favouriteList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FavouriteList  $FavouriteList
     * @return \Illuminate\Http\Response
     */
    public function destroy(FavouriteList $favouriteList)
    {
        //
    }
}
