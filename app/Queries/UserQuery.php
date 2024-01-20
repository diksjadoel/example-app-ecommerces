<?php

namespace App\Queries;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserMenu;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Client;

trait UserQuery
{

    private $uri = 'https://oauth2.googleapis.com/token';
    public function getUserDataToken($request) {
             $credentials = $request;
             if(!$token = auth()->guard('api_admin')->attempt($credentials)) {
                 return response()->json([
                     'success' => false,
                     'message' => 'Email or Password is incorrect'
                 ], 401);
             }
             $user = auth()->guard('api_admin')->user();
             return response()->json([
                'success' => true,
                'user'    => auth()->guard('api_admin')->user(),
                'token'   => $token,
                'expires_in' => JWTAuth::factory()->getTTL() * 60,
                'refresh_token' => $user->createToken('refresh-token')->plainTextToken
            ], 200);
    }
    public function getUserDataMenuAndSubMenu() {
        $userDataMenuAndSubMenu = User::with(['user_roles' => function ($query) {
            $query->with(['user_menus'=>function($queries){
                $queries->with(['usermenuhaspermission' =>function($q){
                        $q->with('userpermissions');
                }]);
                $queries->with(['userSubMenu'=>function($short){
                        $short->where('user_sub_menus_is_active',1);
                }]);
            }]);
        }])
        ->where('user_user_roles_id',auth()->guard('api_admin')->user()->user_user_roles_id)
        ->get();
        return response()->json([
            'success'=>true,
            'userData'=>$userDataMenuAndSubMenu
        ],200);
    }
    public function logout()
    {
        $removeToken = JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json([
            'success' => true,
        ], 200);
    }
    public function userMenus() {
        $userMenu=UserMenu::all();
        return response()->json($userMenu);
    }
    public function signInWithOAuth() {
        try {
            $user =  Socialite::driver('google')->stateless()->user();
        }catch(error) {
            return response()->json(['messages'=>error]);
        }
    }
    public function authCallback() {
        return Socialite::driver('google')->stateless()->redirectUrl('https://example-9t5fbxt47-diksjadoel.vercel.app/api/api/resources/auth/google/callback')
            ->setScopes(['openid', 'profile', 'email'])
        ->redirect();
    }
    public function exchangeAuthorizationCodeWithAccessKey($authOtorizationsCode) {
        $validator = Validator::make($request, [
            'authOtorizationsCode'    => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
          $response = Http::withHeaders([
            'grant_type'    => 'authorization_code',
            'code'          => $authOtorizationsCode,
            'redirect_uri'  => 'https://example-9t5fbxt47-diksjadoel.vercel.app/api/api/resources/google/callback',
            'client_id'     => '9193891811-1kfmvb36dg75ijjtvd8ms7ddn9rsu4d9.apps.googleusercontent.com',
            'client_secret' => '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',
        ])->post($this->uri, [
            'code'=>$authOtorizationsCode
        ]);
        return response()->json([
            $response
        ]);
    }
}
