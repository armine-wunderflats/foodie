<?php

namespace App\Http\Controllers;

use App\Exceptions\InternalErrorException;
use App\Http\Controllers\Controller;
use App\Interfaces\IUserService;
use Illuminate\Http\Request;
use Exception;
use Auth;
use Log;

class UserController extends Controller
{
    private $user_service;

    /**
     * Create a new UserService instance.
     *
     * @param IUserService $user_service
     */
    public function __construct(IUserService $user_service)
    {
        $this->user_service = $user_service;
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(Auth::guard()->user());
    }

    /**
     * Get all users.
     *
     * @param Illuminate\Http\Request
     * 
     * @throws InternalErrorException
     * @return Collection $users
     */
    public function index(Request $request)
    {
        \Log::info($request->user());
        try {
            return $this->user_service->getAllUsers($request->user());
        } catch (Exception $e) {
            Log::error('Get users, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }

    /**
     * Get user by the id.
     *
     * @param int $id
     * @param Illuminate\Http\Request
     * 
     * @throws InternalErrorException
     * @return App\Models\User $user
     */
    public function show(Request $request, $id)
    {
        try {
            return $this->user_service->getUser($id);
        } catch (Exception $e) {
            Log::error('Get user by id, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }

    /**
     * Update user by id
     * 
     * @param int $id
     * @param Illuminate\Http\Request
     * 
     * @throws InternalErrorException 
     * @return App\Models\User $user
     */
    public function updateUser(Request $request, $id)
    {
        try {
            $payload = $request->only([
                'name',
                'email',
                'password',
            ]);

            return $this->user_service->update($id, $payload);
        } catch (Exception $e) {
            Log::error('Update user by id, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }

    /**
     * Delete user by id
     * 
     * @param int $id
     * @param Illuminate\Http\Request
     * 
     * @throws InternalErrorException 
     * @return void
     */
    public function deleteUser(Request $request, $id)
    {
        try {
            $this->user_service->delete($id);
        } catch (Exception $e) {
            Log::error('Delete user by id, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }
}
