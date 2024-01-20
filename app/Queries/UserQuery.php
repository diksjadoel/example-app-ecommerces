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
}
