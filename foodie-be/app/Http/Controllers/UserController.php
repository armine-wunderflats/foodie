<?php

namespace App\Http\Controllers;

use App\Exceptions\InternalErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRestaurantRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Interfaces\IUserService;
use Illuminate\Http\Request;
use Exception;
use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
     * @param int $id
     * 
     * @throws InternalErrorException
     * @throws ModelNotFoundException
     * @return App\Models\User $user
     */
    public function show($id)
    {
        try {
            return $this->user_service->getUser($id);
        } catch (Exception $e) {
            if($e instanceof ModelNotFoundException) {
                Log::warning('Get user by id, ModelNotFoundException', ['error' => $e->getMessage()]);
                throw $e;
            }

            Log::error('Get user by id, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }

    /**
     * Update user by id
     * 
     * @param App\Http\Requests\UpdateUserRequest $request
     * @param int $id
     * 
     * @throws InternalErrorException 
     * @throws ModelNotFoundException 
     * @return App\Models\User $user
     */
    public function updateUser(UpdateUserRequest $request, $id)
    {
        try {
            $payload = $request->only([
                'name',
                'email',
                'password',
            ]);

            return $this->user_service->update($id, $payload);
        } catch (Exception $e) {
            if($e instanceof ModelNotFoundException) {
                Log::warning('Update a user by its id, ModelNotFoundException', ['error' => $e->getMessage()]);
                throw $e;
            }

            Log::error('Update user by id, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }

    /**
     * Delete user by id
     * 
     * @param int $id
     * 
     * @throws InternalErrorException 
     * @throws ModelNotFoundException 
     * @return void
     */
    public function deleteUser($id)
    {
        try {
            $this->user_service->delete($id);
        } catch (Exception $e) {
            if($e instanceof ModelNotFoundException) {
                Log::warning('Delete user by its id, ModelNotFoundException', ['error' => $e->getMessage()]);
                throw $e;
            }

            Log::error('Delete user by id, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }
    
    /**
     * Create a new restaurant.
     * 
     * @param App\Http\Requests\CreateRestaurantRequest $request
     * 
     * @throws InternalErrorException 
     * @return App\Models\Restaurant $restaurant
     */
    public function createRestaurant(CreateRestaurantRequest $request)
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
