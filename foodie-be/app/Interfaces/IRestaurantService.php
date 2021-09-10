<?php

namespace App\Interfaces;

interface IRestaurantService
{
    /**
     * Get all restaurants.
     *
     * @return Collection $restaurants
     */
    public function getAllRestaurants();

    /**
     * Get the restaurant by its id.
     *
     * @param int $id
     *
     * @return App\Models\Restaurant $restaurant
     */
    public function getRestaurant($id);

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
     * @param int[] $mealIds
     * 
     * @return App\Models\Order $order
     */
    public function createOrder($restaurant_id, $data, $mealIds);
}
