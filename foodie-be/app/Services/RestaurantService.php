<?php

namespace App\Services;

use App\Interfaces\IRestaurantService;
use App\Models\Meal;
use App\Models\Order;
use App\Models\Restaurant;
use Carbon\Carbon;
use Log;

class RestaurantService implements IRestaurantService
{
    /**
     * {@inheritdoc}
     */
    public function getAllRestaurants()
    {
        Log::info('Getting all restaurants');
        return Restaurant::all();
    }

    /**
     * {@inheritdoc}
     */
    public function getRestaurant($id)
    {
        Log::info('Getting restaurant by id', ['id' => $id]);
        return Restaurant::findOrFail($id);
    }

    /**
     * {@inheritdoc}
     */
    public function createRestaurant($data, $user)
    {
        Log::info('Creating a new restaurant');
        return $user->restaurants()->create($data);
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, $data)
    {
        Log::info('Updating restaurant', ['id' => $id]);
        $restaurant = $this->getRestaurant($id);
        $restaurant->update($data);
        
        return $restaurant;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        Log::info('Deleting restaurant', ['id' => $id]);
        $restaurant = $this->getRestaurant($id);
        return $restaurant->delete();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getMealsByRestaurantId($id)
    {
        Log::info('Getting all meals by restaurant id');
        return Restaurant::findOrfail($id)->meals()->get();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getRestaurantOrders($id)
    {
        Log::info('Getting all orders by restaurant id');
        return Restaurant::findOrfail($id)->orders()->with('meals')->get();
    }

    /**
     * {@inheritdoc}
     */
    public function createMeal($restaurant_id, $data)
    {
        Log::info('Creating a new meal');
        return Restaurant::findOrFail($restaurant_id)->meals()->create($data);
    }

    /**
     * {@inheritdoc}
     */
    public function createOrder($restaurant_id, $user, $mealIds)
    {
        Log::info('Creating a new order');
        $order = new Order();
        $order->placed_on = Carbon::now();
        $order->user()->associate($user);
        $order = Restaurant::findOrFail($restaurant_id)->orders()->save($order);
        $order->meals()->sync($mealIds);

        return $order;
    }
}