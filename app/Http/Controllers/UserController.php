<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models;
class UserController extends Controller
{

    public function index()
    {
        return Models\User::all();
    }


    public function create()
    {
        $users=Models\User::all();
        return $users;
    }


    public function store(Request $request)
    {
        $data=request();
        $user=Models\User::query()->create(['name'=>$data->name,'email'=>$data->email]);
        return redirect(route('home'));
    }


    public function show($id)
    {
        return Models\User::query()->findOrfail($id);
    }


    public function edit($id)
    {
       ///
    }


    public function update(Request $request, $id)
    {
        $user=Models\User::query()->findOrfail($id);
        $data=request();
        $user->update(['name'=>$data->name,'email'=>$data->email]);
        return redirect(route('home'));
    }


    public function destroy($id)
    {
        $user=Models\User::query()->findOrfail($id);

        try {
            $user->delete($user);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        return redirect(route('home'));
    }
}
