<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\InternalErrorException;
use App\Http\Requests\CreateMealRequest;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\CreateRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Http\Requests\BlockUserRequest;
use Illuminate\Http\Request;
use App\Interfaces\IRestaurantService;
use App\Models\Restaurant;
use Exception;
use Log;

class RestaurantController extends Controller
{
    private $restaurant_service;

    /**
     * Create a new RestaurantService instance.
     *
     * @param IRestaurantService $restaurant_service
     */
    public function __construct(IRestaurantService $restaurant_service)
    {
        $this->restaurant_service = $restaurant_service;
    }
    
    /**
     * Get all restaurants.
     * 
     * @param Illuminate\Http\Request $request
     *
     * @throws InternalErrorException
     * @return Collection $restaurants
     */
    public function index(Request $request)
    {
        try {
            return $this->restaurant_service->getActiveRestaurants($request->filter);
        } catch (Exception $e) {
            Log::error('Get restaurants, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }

    /**
     * Get restaurant by the id.
     *
     * @param int $id
     * 
     * @throws ModelNotFoundException
     * @throws InternalErrorException
     * @return App\Models\Restaurant $restaurant
     */
    public function show($id)
    {
        try {
            return $this->restaurant_service->getRestaurant($id);
        }
        catch (Exception $e) {
            if($e instanceof ModelNotFoundException) {
                Log::warning('Get restaurant by id, ModelNotFoundException', ['error' => $e->getMessage()]);
                throw $e;
            }

            Log::error('Get restaurant by id, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }

    /**
     * Get restaurants by the owner.
     *
     * @param Illuminate\Http\Request $request
     * 
     * @throws ModelNotFoundException
     * @throws InternalErrorException
     * @return Collection $restaurants
     */
    public function getUserRestaurants(Request $request)
    {
        try {
            return $this->restaurant_service->getUserRestaurants($request->user());
        }
        catch (Exception $e) {
            if($e instanceof ModelNotFoundException) {
                Log::warning('Get restaurants by the owner, ModelNotFoundException', ['error' => $e->getMessage()]);
                throw $e;
            }

            Log::error('Get restaurants by the owner, Exception', ['error' => $e->getMessage()]);
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
    public function create(CreateRestaurantRequest $request)
    {
        $this->authorize('create', Restaurant::class);

        try {
            $payload = $request->only([
                'name',
                'food_type',
                'description',
            ]);
            $owner = $request->user();

            return $this->restaurant_service->createRestaurant($payload, $owner);
        } catch (Exception $e) {
            Log::error('Create a new restaurant, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }
    
    /**
     * Display a collection of meals by the restaurant id
     *
     * @param int $id
     * 
     * @throws ModelNotFoundException 
     * @throws InternalErrorException 
     * @return Collection $meals
     */
    public function getMealsByRestaurantId($id)
    {
        try {
            return $this->restaurant_service->getMealsByRestaurantId($id);
        } catch (Exception $e) {
            if($e instanceof ModelNotFoundException) {
                Log::warning('Get meals by restaurant, ModelNotFoundException', ['error' => $e->getMessage()]);
                throw $e;
            }

            Log::error('Get meals by restaurant, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }

    /**
     * Create a new meal.
     * 
     * @param App\Http\Requests\CreateMealRequest $request
     * @param int $id
     *
     * @throws ModelNotFoundException 
     * @throws InternalErrorException 
     * @return App\Models\Meal $meal
     */
    public function createMeal(CreateMealRequest $request, $id)
    {
        $this->authorize('createMeal', $this->show($id));

        try {
            $payload = $request->only([
                'name',
                'description',
                'price',
            ]);

            return $this->restaurant_service->createMeal($id, $payload);
        } catch (Exception $e) {
            if($e instanceof ModelNotFoundException) {
                Log::warning('Create a new meal, ModelNotFoundException', ['error' => $e->getMessage()]);
                throw $e;
            }

            Log::error('Create a new meal, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }

    /**
     * Update restaurant by id
     * 
     * @param App\Http\Requests\UpdateRestaurantRequest $request
     * @param int $id
     * 
     * @throws InternalErrorException 
     * @throws ModelNotFoundException 
     * @return App\Models\Restaurant $restaurant
     */
    public function update(UpdateRestaurantRequest $request, $id)
    {
        $this->authorize('update', $this->show($id));

        try {
            $payload = $request->only([
                'name',
                'food_type',
                'description',
            ]);

            return $this->restaurant_service->update($id, $payload);
        } catch (Exception $e) {
            if($e instanceof ModelNotFoundException) {
                Log::warning('Update restaurant by id, ModelNotFoundException', ['error' => $e->getMessage()]);
                throw $e;
            }

            Log::error('Update restaurant by id, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }

    /**
     * Delete restaurant by id
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
            return $this->restaurant_service->delete($id);
        } catch (Exception $e) {
            if($e instanceof ModelNotFoundException) {
                Log::warning('Delete restaurant by id, ModelNotFoundException', ['error' => $e->getMessage()]);
                throw $e;
            }

            Log::error('Delete restaurant by id, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }

    /**
     * Get the restaurant's orders
     * 
     * @param int $id
     * 
     * @throws ModelNotFoundException 
     * @throws InternalErrorException 
     * @return Collection $orders
     */
    public function getRestaurantOrders($id)
    {
        $this->authorize('getRestaurantOrders', $this->show($id));

        try {
            return $this->restaurant_service->getRestaurantOrders($id);
        } catch (Exception $e) {
            if($e instanceof ModelNotFoundException) {
                Log::warning('Get all orders for the restaurant, ModelNotFoundException', ['error' => $e->getMessage()]);
                throw $e;
            }

            Log::error('Get all orders for the restaurant, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }

    /**
     * Create a new order
     * 
     * @param App\Http\Requests\CreateOrderRequest $request
     * @param int $id
     * 
     * @throws InternalErrorException 
     * @throws ModelNotFoundException 
     * @throws BadRequestException 
     * @return Collection $orders
     */
    public function createOrder(CreateOrderRequest $request, $id)
    {
        $this->authorize('createOrder', $this->show($id));
        $payload = $request->only([
            'mealIds',
            'address',
            'instructions',
        ]);

        try {
            return $this->restaurant_service->createOrder($id, $request->user(), $payload);
        } catch (Exception $e) {
            if($e instanceof ModelNotFoundException) {
                Log::warning('Create a new order for the restaurant, ModelNotFoundException', ['error' => $e->getMessage()]);
                throw $e;
            }

            if($e instanceof BadRequestHttpException) {
                Log::warning('Create a new order for the restaurant, BadRequestHttpException', ['error' => $e->getMessage()]);
                throw $e;
            }

            Log::error('Create a new order for the restaurant, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }
    
    /**
     * Block user by id
     * 
     * @param App\Http\Requests\BlockUserRequest $request
     * @param int $id
     * 
     * @throws InternalErrorException 
     * @throws ModelNotFoundException 
     * @return App\Models\Restaurant $restaurant
     */
    public function blockUser(BlockUserRequest $request, $id)
    {
        $restaurant = $this->show($id);
        $this->authorize('update', $restaurant);

        try {
            return $this->restaurant_service->blockUser($restaurant, $request['user']);
        } catch (Exception $e) {
            if($e instanceof ModelNotFoundException) {
                Log::warning('Block user by id, ModelNotFoundException', ['error' => $e->getMessage()]);
                throw $e;
            }

            Log::error('Block user by id, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }
    
    /**
     * Unblock user by id
     * 
     * @param App\Http\Requests\BlockUserRequest $request
     * @param int $id
     * 
     * @throws InternalErrorException 
     * @throws ModelNotFoundException 
     * @return App\Models\Restaurant $restaurant
     */
    public function unblockUser(BlockUserRequest $request, $id)
    {
        $restaurant = $this->show($id);
        $this->authorize('update', $restaurant);

        try {
            return $this->restaurant_service->unblockUser($restaurant, $request['user']);
        } catch (Exception $e) {
            if($e instanceof ModelNotFoundException) {
                Log::warning('Unblock user by id, ModelNotFoundException', ['error' => $e->getMessage()]);
                throw $e;
            }

            Log::error('Unblock user by id, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }
}
