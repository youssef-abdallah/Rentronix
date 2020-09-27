<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\UserRequest;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = UserRequest::where('user_id', Auth::id())->get()->toJson(JSON_PRETTY_PRINT);
        return response($requests, 200);
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
        $this->validate($request, [
            'image' => 'image|max:1024',
            'datasheet' => 'mimes:pdf|max:10000'
        ]);
        $userRequest = UserRequest::create($data);
        $imageFileName = 'product_'.strval($userRequest->id).'.png';
        $file = $request->file('image')->move(public_path('images'), $imageFileName);
        $imageFileUrl = url('public/images/'.$imageFileName);
        $userRequest->image = $imageFileUrl;
        $datasheetFileName = 'datasheet_'.strval($userRequest->id).'.pdf';
        $file = $request->file('datasheet')->move(public_path('datasheets'), $datasheetFileName);
        $datasheetFileUrl = url('public/images/'.$datasheetFileName);
        $userRequest->datasheet = $datasheetFileUrl;
        $userRequest->user_id = Auth::id();
        $userRequest->save();
        return response()->json([
            'message' => 'request record created'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserRequest  $userRequest
     * @return \Illuminate\Http\Response
     */
    public function show($userRequestId)
    {
        $userRequest = UserRequest::where('user_id', Auth::id())
            ->where('id', $userRequestId)
            ->firstOrFail();
        return response($userRequest, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserRequest  $userRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userRequestId)
    {
        $userRequest = UserRequest::where('user_id', Auth::id())
            ->where('id', $userRequestId)
            ->firstOrFail();
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $userRequest->update($data);
        return response()->json([
            'message' => 'request record updated'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserRequest  $userRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy($userRequestId)
    {
        $userRequest = UserRequest::where('user_id', Auth::id())
            ->where('id', $userRequestId)
            ->firstOrFail();
        $userRequest->delete();
        return response()->json([
            'message' => 'request record deleted'
        ], 200);
    }
}
