<?php

namespace App\Http\Controllers;

use Exception;
use JWTAuth;
use App\Http\Controllers\Controller;
use App\Exceptions\InternalErrorException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Interfaces\IUserService;
use App\Models\User;
use Log;

class AuthController extends Controller
{
    private $user_service;

    public function __construct(IUserService $user_service)
    {
        $this->user_service = $user_service;
    }

    /**
     * Log the user in.
     *
     * @param LoginRequest $request
     *
     * @throws BadRequestHttpException
     * @throws InternalErrorException
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request){
        $credentials = $request->only(['email', 'password']);
        $credentials['email'] = strtolower($credentials['email']);
        
        Log::info('User trying login.', ['email' => $credentials['email']]);

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                throw new BadRequestHttpException('Login credentials are invalid.');
            }
        } catch (JWTException $e) {
            Log::warning('User login failed. Cannot provide token.', ['email' => $credentials['email'], ' error' => $e->getMessage()]);
            throw new InternalErrorException('Could not create token.');
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
            $user = $this->user_service->create($payload);
            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'data' => $user
            ]);
        } catch (Exception $e) {
            Log::warning('User registration failed.', ['error' => $e->getMessage()]);
            throw new InternalErrorException('Could not register user');
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
            throw new InternalErrorException('Could not log out user');
        }
    }
}
