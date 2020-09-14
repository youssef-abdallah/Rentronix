<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::all()->toJson(JSON_PRETTY_PRINT);
        return response($complaints, 200);
    }

    public function show(Complaint $complaint)
    {
        return response($complaint, 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        Complaint::create($data);
        return response()->json([
            'message' => 'complaint record created'
        ], 201);
    }

    public function update(Complaint $complaint, Request $request)
    {
        $complaint->update($request->all());
        return response()->json([
            'message' => 'complaint record updated'
        ], 200);
    }

    public function destroy($complaint)
    {
        Complaint::destroy($complaint);
        return response()->json([
            'message' => 'complaint record deleted'
        ], 200);
    }
}
