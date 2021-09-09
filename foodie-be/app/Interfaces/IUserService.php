<?php

namespace App\Interfaces;

use App\Models\User;

interface IUserService
{
    /**
     * Get all users.
     * 
     * @param App\Models\User $user
     *
     * @return Collection $users
     */
    public function getAllUsers(User $user);

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
     * Update a given user
     * 
     * @param int $id
     * @param array $data
     * 
     * @return App\Models\User $user
     */
    public function update($id, $data);

    /**
     * Create a new user
     * 
     * @param array $data
     * 
     * @return App\Models\User $user
     */
    public function create($data);

    /**
     * Delete a user by its id
     * 
     * @param int $id
     * 
     * @return boolean
     */
    public function delete($id);
}
