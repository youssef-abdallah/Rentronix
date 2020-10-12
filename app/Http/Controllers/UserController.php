<?php
namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\ManufacturerInfo;
use App\Models\Product;
use App\Models\Order;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

    public function isAdmin()
    {
        $user = User::find(Auth::id());
        $isAdmin = $user->hasRole('Admin');
        
        return response()->json([
            'isAdmin' => $isAdmin
        ]);
    }

    public function GetalllManufacturesdetails()
    {
        try {
            $manfactures = ManufacturerInfo::all();

            foreach ($manfactures as $manufacture) {
                $Manufactures_details []= User::find($manufacture->user_id);
            }

            $Manufactures_details = collect($Manufactures_details)->sortBy('name')->toArray();

            return  $Manufactures_details;
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage(),$e->getCode());
        }
        return response()->json(null,204);
    }

    public function GetManufacturesSubcategories($manufacture_id)
    {
        try {
            $Manufactures_products= Product::where('owner_id',$manufacture_id)->get();


            foreach ($Manufactures_products as $product) {
                $Manufactures_subcategories []= $product->subcategory;
            }

            return  $Manufactures_subcategories;


        }
        catch (\Exception $e) {
            return response()->json($e->getMessage(),$e->getCode());
        }
        return response()->json(null,204);
    }
    public function GetManufacturesProducts($manufacture_id,$subcategory_id)
    {
        try {
            $Manufactures_products= Product::where('owner_id',$manufacture_id)->where('subcategory_id',$subcategory_id)->get();


            return  $Manufactures_products;

        }
        catch (\Exception $e) {
            return response()->json($e->getMessage(),$e->getCode());
        }
        return response()->json(null,204);
    }

    public function showUserProfile()
    {
        $user = Auth::user();
        $customerInfo = $user->customerInfo ?? "";
        $manufacturerInfo = $user->manufacturerInfo ?? "";
        $info = json_encode(array("user"=>$user , "customerInfo"=>$customerInfo , "manufacturerInfo"=>$manufacturerInfo));
        return response($info, 200);
    }


}
