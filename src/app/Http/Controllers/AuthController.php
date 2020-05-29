<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        //this is the out of the box middleware for JWT authentication, it applies for all the API endpoints below except for "login".
        //$this->middleware('auth:api', ['except' => ['login', 'signup']]);

        //Defining our own middleware as opposed to the default one defined above. In this middleware we can handle exceptions & etc as we need.
        $this->middleware('jwt', ['except' => ['login', 'signup']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Signup function to add a new users and also to log them in automatically with a valid token
     */
    public function signup(SignupRequest $request){
        $user = $request->all();
        //$user['password'] = bcrypt($user['password']); //encrypting the password using bcrypt. We can also perform this inside the User class using a special Laravel function called "setPasswordAttribute"
        User::create($user);//adding the new user
        return $this->login($request); // login the user using original request
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()->name // getting the current username ("name" is the column name in the table where the user's name is stored )
        ]);
    }

    public function payload()
    {
        return auth()->payload();
    }

    /**
     * Custom method for getting an authenticated user. This is similar to the "public function me()" above.
     * Also contains custom exception handling
     * API endpoint: http://localhost:8080/api/auth/getAuthenticatedUser
     * IMPORTANT: We must make sure the middleware "$this->middleware('auth:api', ['except' => ['login']]);" is commented out in the constructor above
     */
    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (TokenExpiredException $e) {

            return response()->json(['error' => 'token expired'], 400);

        } catch (TokenInvalidException $e) {

            return response()->json(['error' => 'token invalid'], 400);

        } catch (JWTException $e) {

            return response()->json(['error' => 'token absent'], 400);

        }

        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }
}
