<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function _construct()
    {
        $this->middleware('auth:api')->except('index','show');
    }
    public function index(Category $category,Subcategory $subcategory, $product_id)
    {


        $product = Product::find($product_id);
        if (count($product->comments)<1)
        {
            return response()->json('no comments for this product ',404);
        }
        return response( $product->comments, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "rating"=>'required|unique:products_comments',
            "content"=>'required',
            "date_of_publishing"=>'required',
            "product_id"=>'required',
            "user_id" =>'required|max:1000',

        ]);


        Comment::create($validatedData);
        return response()->json([
            'message' => 'comment record created'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $Comment
     * @return \Illuminate\Http\Response
     */
    public function show($category_id,$subcategory_id, $product_id, $comment_id)
    {
        $comment = Comment::find($comment_id);
        if(is_null($comment))
        {
            return response()->json('record not found',404);
        }
        return new CommentResource($comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $Comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $Comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $subcategory_id, $sub_id, $product_id,$comment_id)
    {
        $comment=Comment::find($comment_id);
        if(is_null($comment))
        {
            return response()->json('record not found',404);
        }
        $comment->update($request->all());
        $comment->save();
        return response()->json($comment, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $Comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($category_id, $sub_id, $product_id,$comment_id)
    {
        $comment= Comment::find($comment_id);

        if(is_null($comment))
        {
            return response()->json('record not found',404);
        }
        $comment->delete();
        return response()->json(null,204);
    }
}
