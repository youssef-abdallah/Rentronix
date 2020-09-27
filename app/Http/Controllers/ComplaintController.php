<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::where('user_id', Auth::id())->get()->toJson(JSON_PRETTY_PRINT);
        return response($complaints, 200);
    }

    public function show($complaint)
    {
        $complaint = Complaint::where('user_id', Auth::id())
            ->where('id', $complaint)
            ->firstOrFail();
        return response($complaint, 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        Complaint::create($data);
        return response()->json([
            'message' => 'complaint record created'
        ], 201);
    }

    public function update($complaint, Request $request)
    {
        $complaint = Complaint::where('user_id', Auth::id())
            ->where('id', $complaint)
            ->firstOrFail();
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $complaint->update($data);
        return response()->json([
            'message' => 'complaint record updated'
        ], 200);
    }

    public function destroy($complaint)
    {
        $complaint = Complaint::where('user_id', Auth::id())
            ->where('id', $complaint)
            ->firstOrFail();
        $complaint->delete();
        return response()->json([
            'message' => 'complaint record deleted'
        ], 200);
    }
}
