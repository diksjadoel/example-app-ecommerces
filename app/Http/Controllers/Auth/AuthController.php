<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Module\Usermodules\Userservice;
use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
class AuthController extends Controller
{

    private $userService;

    public function __construct() {
        $this->userService = new Userservice();
    }
    public function userLoggedIn(Request $request) {
        return $this->userService->userValidatedLoginRequests($request->all());
    }
    public function userData() {
        return $this->userService->userSidebarMenu();
    }
    public function refreshToken(Request $request) {
        $refreshToken = JWTAuth::refresh(JWTAuth::getToken());
        $user = JWTAuth::setToken($refreshToken)->toUser();
        $request->headers->set('Authorization','Bearer '.$refreshToken);
        return response()->json([
            'success' => true,
            'user'    => $user,
            'token'   => $refreshToken,
        ], 200);
    }
    public function userLogout() {
        return $this->userService->userLogout();
    }
    public function menu() {
        return $this->userService->getUserMenu();
    }
    public function signInByGoogle() {
        return $this->userService->signInByGoogles();
    }
    public function googleCallback() {
        return $this->userService->googleCallback();
    }
}
