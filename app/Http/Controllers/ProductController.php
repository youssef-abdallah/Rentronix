<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Validator ;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function _construct()  /* for authentication    */
    {
        $this->middleware('auth:api')->except('index','show');

    }

    public function index(Category $category,Subcategory $subcategory)
    {
        if (count($subcategory->products)<1)
        {
            return response()->json('no products for this subcategory ',404);
        }
        $array=$subcategory->products;
        $array = collect($array)->sortBy('name')->toArray();
        return response($array, 200);
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
    public function store(Request $request,$category_id,$subcategory_id)
    {

        $validatedData = $request->validate([
            'name'=>'required|unique:products',
            'product_overview'=>'required',
            'datasheet_url'=>'required',
            'image_url'=>'required',
            'available_stock' =>'required|max:1000',
            'rental_price' =>'required',
            'selling_price'=>'required',
            'subcategory_id' =>'required',
            'owner_id'=>'required',
        ]);


        Product::create($validatedData);
        return response()->json([
            'message' => 'product record created'
        ], 201);


        return response()->json([
            'message' => 'product record created'
        ], 201);

      /* $product= new Product;
       $product->name = $request->name ;
       $product->product_overview = $request->product_overview ;
       $product->available_stock = $request->available_stock ;
       $product->rental_price = $request->rental_price;
       $product->selling_price = $request->selling_price ;
       $product->subcategory_id = $request->subcategory_id ;
       $product->owner_id = $request->owner_id ;

       $product->save();
       return response(['data'=> new ProductRequest($product),201]);
*/


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function show( $category_id, $subcategory_id, $product_id)
    {

        $product=Product::find($product_id);
        if(is_null($product))
        {
            return response()->json([message =>'record not found'],404);
        }
        return new ProductResource($product);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $subcategory_id, $sub_id, $product_id)
    {
        $product=Product::find($product_id);
        if(is_null($product))
        {
            return response()->json([message =>'record not found'],404);
        }
        $product->update($request->all());
        $product->save();
        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function destroy($category_id, $sub_id, $product_id)
    {
        $product= Product::find($product_id);
        if(is_null($product))
        {
            return response()->json([message =>'record not found'],404);
        }
        $product->delete();
        return response()->json(null,204);
    }

    public function ProductSearch()
    {
        $query = (string)request('q');

        return Product::query()
            ->where('name', 'like', "%{$query}%")
            ->orderBy('name')
            ->get();

    }

    public function ProductSearchBuy()
    {
        $query = (string)request('q');

        return Product::query()
            ->where('name', 'like', "%{$query}%")
            ->where('available_for', 'like', 'buy')
            ->orderBy('name')
            ->get();

    }
    public function ProductSearchRent()
    {

        $query = (string)request('q');
        return Product::query()
            ->where('name', 'like', "%{$query}%")
            ->where('available_for', 'like', 'rent')
            ->orderBy('name')
            ->get();

    }

    public function showAll()
    {
        $products = Product::all()->sortBy('name')->toJson(JSON_PRETTY_PRINT)  ;

          return $products;
    }


}
