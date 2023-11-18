<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
class JwtCheckMiddlware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (TokenBlacklistedException $e) {
            return response()->json(['success'=>false,'message'=>$e],status: 401);
        }catch (TokenExpiredException $e) {
            return response()->json(['success'=>false,'message'=>'token_expired'], status:401);
        } catch (TokenInvalidException $e) {
            return response()->json(['success'=>false,'messages'=>'token_invalid'], status: 401);
        } catch (JWTException $e) {
            return response()->json(['success'=>false,'message'=>'token_not_found please login'], status: 401);
        }
        return $next($request);
    }
}
