<?php
namespace App\Http\Controllers;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index()
    {
        return response()->json(User::get(),200);
    }
    public function store(Request $request)
    {
        $data=User::query()->create($request->all());
        return response()->json($data,201);
    }
    public function show($id)
    {
        return response()->json(User::query()->find($id),200);
    }
    public function update(Request $request)
    {

        $id=Auth::id();
        DB::table('users')
        ->where('id', $id)
        ->update($request->only(['name', 'email', 'phone_no', 'password']));
        return response()->json([
            'message' => 'user record updated'
        ],200);
    }
    public function destroy()
    {
        $id=Auth::id();
        DB::table('users')->where('id', $id)->delete();
        return response()->json([
            'message' => 'user record deleted'
        ],204);
    }
}
