<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

use App\Http\Controllers\UserController;
use Exception;
//use App\Services\SocialFacebookAccountService;
use Illuminate\Http\Request;


class FacebookController extends Controller
{



    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(\App\Services\SocialFacebookAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());
        auth()->login($user);
        return redirect()->to('/home');
    }

    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $create['name'] = $user->getName();
            $create['email'] = $user->getEmail();
            $create['facebook_id'] = $user->getId();
            $create['facebook_token'] = $user->token;


            $userModel = new User;
            $createdUser = $userModel->addNew($create);
            Auth::loginUsingId($createdUser->id);


            return redirect()->route('home');


        } catch (Exception $e) {

            dd($e);
            //return redirect('auth/facebook');
        }
    }
    public function loginFromToken(Request $request) {    
        $user = Socialite::driver('facebook')->userFromToken( $request->input('access_token'));
        abort_if($user == null || $user->id != $request->input('user_id'), 400, 'Invalid credentials');
        $existing_user = User::where('facebook_id', $user->id)->first();
        if (is_null($existing_user))
        {
            $create['name'] = $user->getName();
            $create['email'] = $user->getEmail();
            $create['facebook_id'] = $user->getId();
            $create['facebook_token'] = $user->token;
            $userModel = new User;
            $existing_user = $userModel->addNew($create);
        }
        return $this->issueToken($existing_user, $request->client_id, $request->client_secret);
    }        

    private function issueToken(User $user, $client_id, $client_secret) {
        $request = Request::create('http://localhost:8000/oauth/token', 'POST', [
            'grant_type' => 'client_credentials',
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'user_id' => $user->id,
        ]);
        $response = app()->handle($request);
        $response = json_decode($response->getContent(), true);
        if (array_key_exists('error', $response)) return $response;
        $userToken = $user->token() ?? $user->createToken('socialLogin');
        return [
            "token_type" => "Bearer",
            "access_token" => $userToken->accessToken
        ];
    }
}
