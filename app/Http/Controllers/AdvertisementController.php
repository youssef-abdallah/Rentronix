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

    public function show($advertisementId)
    {
        $advertisement = Advertisement::findOrFail($advertisementId);
        return response($advertisement, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|max:1024'
        ]);
        $advertisement = new Advertisement();
        $advertisement->product_id = $request->product_id;
        $fileName = 'ad_'.strval($advertisement->id).'.png';
        $file = $request->file('image')->move(public_path('images'), $fileName);
        $fileUrl = url('public/images/'.$fileName);
        $advertisement->image = $fileUrl;
        $advertisement->save();
        return response()->json([
            'message' => 'advertisement record created',
            'image_url' => $fileUrl,
        ], 201);
    }

    public function update($advertisementId, Request $request)
    {
        $advertisement = Advertisement::findOrFail($advertisementId);
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
