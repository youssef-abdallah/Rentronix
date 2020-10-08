<?php

namespace App\Http\Controllers;


use App\Http\Resources\PromocodeResource;
use App\Models\Promocode;
use Illuminate\Http\Request;

class PromocodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $promo = Promocode::all()->toJson(JSON_PRETTY_PRINT);
        return response($promo, 200);
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
            'promocode'=>'required|unique:promocodes',
            'expiredDate'=>'required',
        ]);

        Promocode::create($validatedData);
        return response()->json([
            'message' => 'promocode record created'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */
    public function show($promocode_id)
    {
        $promocode=Promocode::find($promocode_id);
        if(is_null($promocode))
        {
            return response()->json([message =>'record not found'],404);
        }
        return new PromocodeResource($promocode);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */
    public function destroy($promocode_id)
    {

        $promocode=Promocode::find($promocode_id);
        if(is_null($promocode))
        {
            return response()->json('record not found',404);
        }
        $promocode->delete();
        return response()->json(null,204);
    }
}
