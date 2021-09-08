<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Interfaces\IUserService;
use App\Models\User;
use Log;

class UserService implements IUserService
{
    /**
     * {@inheritdoc}
     */
    public function getAllUsers($user)
    {
        Log::info('Getting all users');

        $this->validateAdmin($user);

        return User::all();
    }

    /**
     * {@inheritdoc}
     */
    public function getUser($id)
    {
        Log::info('Getting user by id', ['id' => $id]);

        return User::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function getUserByEmail($email)
    {
        Log::info('Getting user by email', ['email' => $email]);

        return User::where('email', $email)->first();
    }

    /**
     * {@inheritdoc}
     */
    public function update($user, $data)
    {
        Log::info('Updating user');
        
        return $user->update($data);
    }

    /**
     * {@inheritdoc}
     */
    public function create($data)
    {
        Log::info('Creating user');
        
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $user->assignRole('visitor');

        return $user;
    }
    
    private function validateAdmin($user)
    {
        if(!$user->is_admin) {
            Log::warning("Invalid User");
            throw new \Exception("Invalid User");
        }
    }
}