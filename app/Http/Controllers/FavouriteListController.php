<?php

namespace App\Http\Controllers;

use App\Models\FavouriteList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteListController extends Controller
{
    public function _construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $id=Auth::id();
        $fav=FavouriteList::query()->where('user_id','=',$id)->get();
        return response()->json($fav,200);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        FavouriteList::create($data);
        return response()->json([
            'message' => 'favouriteList record created'
        ], 201);
    }


    public function show($favouriteList)
    {
        return response()->json(FavouriteList::query()->find($favouriteList),200);
    }


    public function update(Request $request, FavouriteList $favouriteList)
    {
        $favouriteList->update($request->all());
        return response()->json([
            'message' => 'favouriteList record updated'
        ], 200);
    }


    public function destroy(FavouriteList $favouriteList)
    {
        FavouriteList::destroy($favouriteList);
        return response()->json([
            'message' => 'favouriteList record deleted'
        ], 200);
    }
}
