<?php

namespace App\Interfaces;

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
     * @param App\Models\User $user
     * @param array $data
     * 
     * @return App\Models\User $user
     */
    public function update(User $user, $data);

    /**
     * Create a new user
     * 
     * @param array $data
     * 
     * @return App\Models\User $user
     */
    public function create($data);
}
