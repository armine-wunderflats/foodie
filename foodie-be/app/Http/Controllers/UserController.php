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
     * @throws InternalErrorException
     * @return Collection $users
     */
    public function index()
    {
        try {
            return $this->user_service->getAllUsers();
        } catch (Exception $e) {
            Log::error('Get users, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }

    /**
     * Get user by the id.
     *
     * @param Illuminate\Http\Request $request
     * @param int $id
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
     * @param Illuminate\Http\Request $request
     * @param int $id
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
     * @param Illuminate\Http\Request $request
     * @param int $id
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
    
    /**
     * Create a new restaurant.
     * 
     * @param Illuminate\Http\Request $request
     *
     * @throws InternalErrorException 
     * @return App\Models\Restaurant $restaurant
     */
    public function createRestaurant(Request $request)
    {
        try {
            $payload = $request->only([
                'name',
                'food_type',
                'description',
            ]);
            $owner = $request->user();

            return $this->user_service->createRestaurant($payload, $owner);
        } catch (Exception $e) {
            Log::error('Create a new restaurant, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }

    /**
     * Get the user's orders
     * 
     * @param Illuminate\Http\Request $request
     * 
     * @throws InternalErrorException 
     * @return Collection $orders
     */
    public function getUserOrders(Request $request)
    {
        try {
            return $this->user_service->getUserOrders($request->user());
        } catch (Exception $e) {
            Log::error(' Get all orders for the user, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }
}
