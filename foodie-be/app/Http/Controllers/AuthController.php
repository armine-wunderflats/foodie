<?php

namespace App\Http\Controllers;

use Exception;
use JWTAuth;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Interfaces\IUserService;
use App\Models\User;
use Log;

class AuthController extends Controller
{
    private $users_service;

    public function __construct(IUserService $users_service)
    {
        $this->users_service = $users_service;
    }

    /**
     * Log the user in.
     *
     * @param LoginRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request){
        $credentials = $request->only(['email', 'password']);
        $credentials['email'] = strtolower($credentials['email']);
        
        Log::info('User trying login.', ['email' => $credentials['email']]);

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {
            Log::warning('User login failed. Cannot provide token.', ['email' => $credentials['email'], ' error' => $e->getMessage()]);

            return response()->json([
                    'success' => false,
                    'message' => 'Could not create token.',
                ], 500);
        }

        //Token created, return with success response and jwt token
        $user = User::where('email', '=', $credentials['email'])->first();
        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $token,
        ]);
    }
    
    /**
     * Register a new user.
     *
     * @param RegistrationRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegistrationRequest $request){
        $payload = $request->only(['name', 'password', 'email']);
        Log::info('User trying to register.');
        
        try{
            $user = $this->users_service->create($payload);
            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'data' => $user
            ], Response::HTTP_OK);
        }
        catch (Exception $e) {
            Log::warning('User registration failed.', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Could not register user'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate($request->token);
            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Could not log out user'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
