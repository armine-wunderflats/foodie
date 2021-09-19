<?php

namespace App\Interfaces;

interface IRestaurantService
{
    /**
     * Get all restaurants.
     * 
     * @param string $filter
     *
     * @return Collection $restaurants
     */
    public function getActiveRestaurants($filter);

    /**
     * Get the restaurant by its id.
     *
     * @param int $id
     *
     * @return App\Models\Restaurant $restaurant
     */
    public function getRestaurant($id);

    /**
     * Get the restaurants by its owner.
     *
     * @param App\Models\User $owner
     *
     * @return Collection $restaurants
     */
    public function getUserRestaurants($owner);
    
    /**
     * Create a new restaurant
     * 
     * @param array $data
     * @param App\Models\User $owner
     * 
     * @return App\Models\Restaurant $restaurant
     */
    public function createRestaurant($data, $owner);

    /**
     * Update a given restaurant
     * 
     * @param int $id
     * @param array $data
     * 
     * @return App\Models\Restaurant $restaurant
     */
    public function update($id, $data);

    /**
     * Delete a restaurant by its id
     * 
     * @param int $id
     * 
     * @return boolean
     */
    public function delete($id);

    /**
     * Get all meals.
     * 
     * @param int $id
     *
     * @return Collection $meals
     */
    public function getMealsByRestaurantId($id);

    /**
     * Create a new meal
     * 
     * @param array $data
     * @param id $restaurant_id
     * 
     * @return App\Models\Meal $meal
     */
    public function createMeal($restaurant_id, $data);

    /**
     * Get the restaurant's orders
     * 
     * @param int $id
     * 
     * @return Collection $orders
     */
    public function getRestaurantOrders($id);

    /**
     * Create a new order
     * 
     * @param id $restaurant_id
     * @param App\Models\User $user
     * @param array $data
     * 
     * @return App\Models\Order $order
     */
    public function createOrder($restaurant_id, $user, $data);

    /**
     * Block a user from ordering from the restaurant
     * 
     * @param App\Models\Restaurant $restaurant
     * @param id $user_id
     * 
     * @return void
     */
    public function blockUser($restaurant, $user_id);

    /**
     * Unlock a user from ordering from the restaurant
     * 
     * @param App\Models\Restaurant $restaurant
     * @param id $user_id
     * 
     * @return void
     */
    public function unblockUser($restaurant, $user_id);
}
