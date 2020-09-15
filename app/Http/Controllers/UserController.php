<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {

        return response()->json(Models\User::get(),200);



    }


    public function create()
    {

        ///

    }


    public function store(Request $request)
    {

        $data=Models\User::query()->$request->all();
        return response()->json($data,201);

    }


    public function show($id)
    {

        return response()->json(Models\User::query()->find($id),200);

    }


    public function edit($id)
    {
       ///
    }


    public function update(Request $request, $id)
    {

        $id->update($request->all());
        return response()->json($id,200);

    }


    public function destroy($id)
    {

        $id->delete();
        return response()->json(null,204);



    }
}
