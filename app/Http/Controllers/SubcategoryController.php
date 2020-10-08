<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\SubcategoryResource;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        if (count($category->subcategory)<1)
        {
            return response()->json('no subcategories for this category ',404);
        }
        $array=$category->subcategory;
        $array = collect($array)->sortBy('title')->toArray();
        return response($array, 200);


    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validatedData = $request->validate([
            'title'=>'required|unique:subcategories',
            'description'=>'required',
            'category_id'=>'required',

        ]);


        Subcategory::create($validatedData);
        return response()->json([
            'message' => 'subcategory is saved record created'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\subcategories  $subcategories
     * @return \Illuminate\Http\Response
     */
    public function show( $category ,$subcategory_id)
    {
        $subcategory= Subcategory::find($subcategory_id);
        if(is_null($subcategory))
        {
            return response()->json('record not found',404);
        }

        return new SubcategoryResource($subcategory);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcategory $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category, $sub)
    {
        $subcategory=Subcategory::find($sub);
        if(is_null($subcategory))
        {
            return response()->json('record not found',404);
        }
        $subcategory->update($request->all());
        $subcategory->save();
        return response()->json( $subcategory, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\subcategories  $subcategories
     * @return \Illuminate\Http\Response
     */
    public function destroy($category_id, $sub_id)
    {
        $subcategory= Subcategory::find($sub_id);
        if(is_null($subcategory))
        {
            return response()->json('record not found',404);
        }
        $subcategory->delete();
        return response()->json(null,204);
    }

    public function SubCategorySearch()
    {
        $query = (string)request('q');

        return Subcategory::query()
            ->where('title', 'like', "%{$query}%")
            ->orderBy('title')
            ->get();

    }


    public function showAll()
    {
        $subcategories = Subcategory::all()->sortBy('title')->toJson(JSON_PRETTY_PRINT)  ;
               return $subcategories;
    }


}
