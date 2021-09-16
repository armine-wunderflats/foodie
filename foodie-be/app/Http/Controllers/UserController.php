<?php

namespace App\Http\Controllers;

use App\Exceptions\InternalErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Interfaces\IUserService;
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
        $this->authorize('viewAll', User::class);

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
            $user = $this->user_service->getUser($id);
        } catch (Exception $e) {
            if($e instanceof ModelNotFoundException) {
                Log::warning('Get user by id, ModelNotFoundException', ['error' => $e->getMessage()]);
                throw $e;
            }

            Log::error('Get user by id, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }

        $this->authorize('view', $user);

        return $user;
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
    public function update(UpdateUserRequest $request, $id)
    {
        $this->authorize('update', $this->show($id));

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
    public function destroy($id)
    {
        $this->authorize('delete', $this->show($id));

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
}
