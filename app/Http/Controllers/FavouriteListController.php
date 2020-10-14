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
        $favouritelist = FavouriteList::with('product')->where("user_id", Auth::id())->get()->toJson(JSON_PRETTY_PRINT);;
        return response($favouritelist, 200);

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
        $this->validate($request, array(
            'user_id'=>'required',
            'product_id' =>'required',
           ));
           
           $status=FavouriteList::where('user_id',Auth::user()->id)
           ->where('product_id',$request->product_id)
           ->first();
           
           if(isset($status->user_id) and isset($request->product_id))
              {
                return response()->json(['message' => 'The products is already added to the favourite list'], 201);
              }
              else
              {
                
                $favouritelist = new FavouriteList;
                $favouritelist->user_id = $request->user_id;
                $favouritelist->product_id = $request->product_id;
                $favouritelist->save();
                return response()->json([
                    'message' => 'added to favourite list'
                ], 201);
             }
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
    public function destroy($id)
    {
        //
        $favouritelist = FavouriteList::findOrFail($id);
        $favouritelist->delete();

        return response()->json([
            'message' => 'favouritelist deleted'
        ], 200);
    }
}
