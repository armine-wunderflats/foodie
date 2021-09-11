<?php

namespace App\Services;

use App\Interfaces\IUserService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Log;

class UserService implements IUserService
{
    /**
     * {@inheritdoc}
     */
    public function getAllUsers()
    {
        Log::info('Getting all users');
        return User::all();
    }

    /**
     * {@inheritdoc}
     */
    public function getUser($id)
    {
        Log::info('Getting user by id', ['id' => $id]);
        return User::findOrFail($id);
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
    public function create($data, $isOwner)
    {
        Log::info('Creating user');
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $isOwner ? 
            $user->assignRole(constants('ROLES.OWNER')) :
            $user->assignRole(constants('ROLES.CUSTOMER'));

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, $data)
    {
        Log::info('Updating user', ['id' => $id]);
        $user = $this->getUser($id);
        $user->update($data);
        
        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        Log::info('Deleting user', ['id' => $id]);
        $user = $this->getUser($id);
        return $user->delete();
    }
}