<?php

namespace App\Http\Controllers;

use App\Exceptions\InternalErrorException;
use App\Interfaces\IRestaurantService;
use App\Models\Restaurant;
use Exception;
use Illuminate\Http\Request;
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
            return $this->restaurant_service->getAllRestaurants();
        } catch (Exception $e) {
            Log::error('Get restaurants, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }

    /**
     * Get restaurant by the id.
     *
     * @param Illuminate\Http\Request $request
     * @param int $id
     * 
     * @throws InternalErrorException
     * @return App\Models\Restaurant $restaurant
     */
    public function show(Request $request, $id)
    {
        try {
            return $this->restaurant_service->getRestaurant($id);
        } catch (Exception $e) {
            Log::error('Get restaurant by id, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }
    
    /**
     * Display a collection of meals by the restaurant id
     *
     * @param Illuminate\Http\Request $request
     * @param int $id
     * 
     * @throws InternalErrorException 
     * @return Collection $meals
     */
    public function getMealsByRestaurantId(Request $request, $id)
    {
        try {
            return $this->restaurant_service->getMealsByRestaurantId($id);
        } catch (Exception $e) {
            Log::error('Get meals by restaurant, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }

    /**
     * Create a new meal.
     * 
     * @param Illuminate\Http\Request $request
     * @param int $id
     *
     * @throws InternalErrorException 
     * @return App\Models\Meal $meal
     */
    public function createMeal(Request $request, $id)
    {
        try {
            $payload = $request->only([
                'name',
                'description',
                'price',
            ]);

            return $this->restaurant_service->createMeal($id, $payload);
        } catch (Exception $e) {
            Log::error('Create a new meal, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }

    /**
     * Update restaurant by id
     * 
     * @param Illuminate\Http\Request $request
     * @param int $id
     * 
     * @throws InternalErrorException 
     * @return App\Models\Restaurant $restaurant
     */
    public function updateRestaurant(Request $request, $id)
    {
        try {
            $payload = $request->only([
                'name',
                'food_type',
                'description',
            ]);

            return $this->restaurant_service->update($id, $payload);
        } catch (Exception $e) {
            Log::error('Update restaurant by id, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }

    /**
     * Delete restaurant by id
     * 
     * @param Illuminate\Http\Request $request
     * @param int $id
     * 
     * @throws InternalErrorException 
     * @return void
     */
    public function deleteRestaurant(Request $request, $id)
    {
        try {
            $this->restaurant_service->delete($id);
        } catch (Exception $e) {
            Log::error('Delete restaurant by id, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }

    /**
     * Get the restaurant's orders
     * 
     * @param Illuminate\Http\Request $request
     * @param int $id
     * 
     * @throws InternalErrorException 
     * @return Collection $orders
     */
    public function getRestaurantOrders(Request $request, $id)
    {
        try {
            return $this->restaurant_service->getRestaurantOrders($id);
        } catch (Exception $e) {
            Log::error('Get all orders for the restaurant, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }

    /**
     * Create a new order
     * 
     * @param Illuminate\Http\Request $request
     * @param int $id
     * 
     * @throws InternalErrorException 
     * @return Collection $orders
     */
    public function createOrder(Request $request, $id)
    {
        try {
            return $this->restaurant_service->createOrder($id, $request->user(), $request['mealIds']);
        } catch (Exception $e) {
            Log::error('Create a new order for the restaurant, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }
}
