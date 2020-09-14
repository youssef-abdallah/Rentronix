<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function index()
    {
        $advertisements = Advertisement::all()->toJson(JSON_PRETTY_PRINT);
        return response($advertisements, 200);
    }

    public function show(Advertisement $advertisement)
    {
        return response($advertisement, 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        Advertisement::create($data);
        return response()->json([
            'message' => 'advertisement record created'
        ], 201);
    }

    public function update(Advertisement $advertisement, Request $request)
    {
        $advertisement->update($request->all());
        return response()->json([
            'message' => 'advertisement record updated'
        ], 200);
    }

    public function destroy($advertisement)
    {
        Advertisement::destroy($advertisement);
        return response()->json([
            'message' => 'advertisement record deleted'
        ], 200);
    }
}
