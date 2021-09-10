<?php

namespace App\Interfaces;

use App\Models\User;

interface IUserService
{
    /**
     * Get all users.
     * 
     * @return Collection $users
     */
    public function getAllUsers();

    /**
     * Get user by the id.
     *
     * @param int $id
     *
     * @return App\Models\User $user
     */
    public function getUser($id);

    /**
     * Get user by email.
     *
     * @param string $email
     *
     * @return App\Models\User $user
     */
    public function getUserByEmail($email);

    /**
     * Create a new user
     * 
     * @param array $data
     * @param boolean $isOwner
     * 
     * @return App\Models\User $user
     */
    public function create($data, $isOwner);

    /**
     * Update a given user
     * 
     * @param int $id
     * @param array $data
     * 
     * @return App\Models\User $user
     */
    public function update($id, $data);

    /**
     * Delete a user by its id
     * 
     * @param int $id
     * 
     * @return boolean
     */
    public function delete($id);
    
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
     * Get the user's orders
     * 
     * @param App\Models\User $user
     * 
     * @return Collection $orders
     */
    public function getUserOrders($user);
}
