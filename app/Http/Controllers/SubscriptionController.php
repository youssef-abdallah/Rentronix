<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Subscription;
use App\Mail\Subscribed;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        Mail::to($request->email)->send(new Subscribed());
        Subscription::create($request->all());
        return response()->json([
            'message' => 'Thanks for subscribing. Please check your mail.'
        ], 200);
    }
}
