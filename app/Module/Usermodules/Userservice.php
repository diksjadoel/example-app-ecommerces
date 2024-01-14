<?php

namespace App\Module\Usermodules;
use App\Queries\UserQuery;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
class Userservice {

    use UserQuery;

    public function userValidatedLoginRequests( $request) {
            $validator = Validator::make($request, [
                'email'    => 'required|email',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            return $this->getUserDataToken($request);
    }
    public function userSidebarMenu() {
            return $this->getUserDataMenuAndSubMenu();
    }
    public function userRefreshToken( $token) {
       $this->getUserNewRefreshToken($token);
    }
    public function userLogout(){
        return $this->logout();
    }
    public function getUserMenu() {
       return $this->userMenus();
    }
    public function signInByGoogles() {
       return $this->signInWithOAuth();
    }
    public function googleCallback() {
        return $this->authCallback();
    }
}
