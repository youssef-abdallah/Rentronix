<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        $url = Socialite::driver('google')->redirect()->getTargetUrl();
        return response()->json([
            'url' => $url
        ]);
    }


    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('Google')->user();
            $create['name'] = $user->getName();
            $create['email'] = $user->getEmail();
            $create['google_id'] = $user->getId();


            $userModel = new User;
            $createdUser = $userModel->addNewGoogle($create);
            Auth::loginUsingId($createdUser->id);

            dd($user);
            return redirect()->route('home');


        } catch (Exception $e) {
            return redirect('auth/google');
        }
    }

    public function loginFromToken(Request $request) {    
        $user = Socialite::driver('google')->userFromToken( $request->input('access_token'));
        abort_if($user == null || $user->id != $request->input('user_id'), 400, 'Invalid credentials');
        $existing_user = User::where('google_id', $user->id)->first();
        if (is_null($existing_user))
        {
            $create['name'] = $user->getName();
            $create['email'] = $user->getEmail();
            $create['google_id'] = $user->getId();
            $create['google_token'] = $user->token;
            $userModel = new User;
            $existing_user = $userModel->addNew($create);
        }
        $response = $this->issueToken($existing_user, $request->client_id, $request->client_secret);
        if (array_key_exists('error', $response))
        {
            $existing_user->delete();
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
        if (array_key_exists('error', $response)) return $response;
        $userToken = $user->token() ?? $user->createToken('socialLogin');
        return [
            "token_type" => "Bearer",
            "access_token" => $userToken->accessToken
        ];
    }
}
