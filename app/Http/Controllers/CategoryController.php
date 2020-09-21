<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category,Subcategory $subcategory)
    {
        $categories = Category::all()->toJson(JSON_PRETTY_PRINT);
        return response($categories, 200);
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
        $data = $request->all();
        Category::create($data);
        return response()->json([
            'message' => 'category record created'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($category_id)
    {
        $category= Category::find($category_id);

        if(is_null($category))
        {
            return response()->json('record not found',404);
        }
        return new CategoryResource($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $category_id)
    {
        $category= Category::find($category_id);
        if(is_null($category))
        {
            return response()->json('record not found',404);
        }
        $category->update($request->all());

        return response()->json( $category, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy( $category_id)
    {
        $category= Category::find($category_id);
        if(is_null($category))
        {
            return response()->json('record not found',404);
        }
        $category->delete();
        return response()->json(null,204);
    }
}
