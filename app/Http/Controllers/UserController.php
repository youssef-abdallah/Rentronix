<?php
namespace App\Http\Controllers;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\User;

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
    public function update(Request $request,User $id)
    {
        $id->update($request->all());
        return response()->json($id,200);
    }
    public function destroy(User $user)
    {
        try {
            $user->delete();
        } catch (\Exception $e) {
            return response()->json($e->getMessage(),$e->getCode());
        }
        return response()->json(null,204);
    }
    public function showWallet(User $user)
    {
        $customerWallet = $user->customerInfo->wallet ?? "";
        $manufacturerWallet = $user->manufacturerInfo->wallet ?? "";
        $wallet = json_encode(array("customerWallet"=>$customerWallet , "manufacturerWallet"=>$manufacturerWallet));
        return response($wallet, 200);
    }
}
