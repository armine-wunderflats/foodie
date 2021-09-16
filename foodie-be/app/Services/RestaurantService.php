<?php

namespace App\Services;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
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
    public function getActiveRestaurants($filter)
    {
        Log::info('Getting restaurants');
        return Restaurant::active()
            ->where('name', 'LIKE', '%'.$filter.'%')
            ->orWhere('food_type', 'LIKE', '%'.$filter.'%')
            ->paginate(constants('PAGINATION_SIZE'));
    }

    /**
     * {@inheritdoc}
     */
    public function getRestaurant($id)
    {
        Log::info('Getting restaurant by id', ['id' => $id]);
        return Restaurant::with('meals')->findOrFail($id);
    }

    /**
     * {@inheritdoc}
     */
    public function getUserRestaurants($owner)
    {
        Log::info('Getting restaurant by the owner', ['owner id' => $owner->id]);
        return $owner->restaurants()->with('meals')->get();
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
        return Restaurant::findOrFail($id)->meals()->get();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getRestaurantOrders($id)
    {
        Log::info('Getting all orders by restaurant id');
        return Restaurant::findOrFail($id)->orders()->with('meals')->get();
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
    public function createOrder($restaurant_id, $user, $data)
    {
        Log::info('Creating a new order');
        $mealIds = $this->filterMealIds($restaurant_id, $data['mealIds']);

        $order = new Order([
            'address' => $data['address'],
            'instructions' => array_key_exists('instructions', $data) ? $data['instructions'] : '',
            'placed_on' => Carbon::now(),
        ]);
        $order->user()->associate($user);
        $order = Restaurant::findOrFail($restaurant_id)->orders()->save($order);
        $order->meals()->attach($mealIds);

        return $order;
    }

    private function filterMealIds($restaurant_id, $mealIds)
    {
        $array = [];
        foreach($mealIds as $id) {
            $meal = Meal::findOrFail($id);
            if($meal->restaurant->id == $restaurant_id) $array[] = $id;
        }

        if(count($array) == 0) {
            throw new BadRequestHttpException('The order doesn\'t have any meals from the given restaurant');
        }

        return $array;
    }
}