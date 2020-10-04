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
        $url = Socialite::driver('facebook')->redirect()->getTargetUrl();
        return response()->json([
            'url' => $url
        ]);
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
            $existingUser = $userModel->addNew($create);
            Auth::loginUsingId($existingUser->id);

            $response = [
                'user' => $user,
                'token' => $user->token
            ];
            
            $response = $this->issueToken($existingUser,
                env('PASSPORT_PERSONAL_ACCESS_CLIENT_ID'),
                env('PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET'));
            
            
            return redirect()->route('home')
                ->withCookie(cookie('token', $response['access_token'],
                    1, null, null, false, false));



        } catch (Exception $e) {

            dd($e);
            //return redirect('auth/facebook');
        }
    }
    
    public function loginFromToken(Request $request) {    
        $user = Socialite::driver('facebook')->userFromToken( $request->input('access_token'));
        abort_if($user == null || $user->id != $request->input('user_id'), 400, 'Invalid credentials');
        $existingUser = User::where('facebook_id', $user->id)->first();
        if (is_null($existingUser))
        {
            $create['name'] = $user->getName();
            $create['email'] = $user->getEmail();
            $create['facebook_id'] = $user->getId();
            $create['facebook_token'] = $user->token;
            $userModel = new User;
            $existingUser = $userModel->addNew($create);
        }
        $response = $this->issueToken($existingUser, $request->client_id, $request->client_secret);
        if (isset($response['error']))
        {
            $existingUser->delete();
        }
        return $response;
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
        if (isset($response['error'])) return $response;
        $userToken = $user->token() ?? $user->createToken('socialLogin');
        return [
            "token_type" => "Bearer",
            "access_token" => $userToken->accessToken
        ];
    }
}
