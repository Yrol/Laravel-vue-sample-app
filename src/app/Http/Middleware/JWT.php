<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JWT extends BaseMiddleware
{
    /**
     * Middleware to handle Token Authentication
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //in here we're authenticating the Token before going into the Route. Hence, this is an extra security layer for protecting the token API
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (TokenExpiredException $e) {

            return response()->json(['error' => 'token expired'], 400);

        } catch (TokenInvalidException $e) {

            return response()->json(['error' => 'token invalid'], 400);

        } catch (JWTException $e) {// this will trigger if the token is not provided

            return response()->json(['error' => 'token absent'], 400);

        }
        return $next($request);
    }
}
