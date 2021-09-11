<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
        
    protected $appends = [
        'is_owner',
        'is_admin',
        'is_customer',
        'blocked_restaurant_ids',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
    
    public function restaurants()
    {
        return $this->hasMany(Restaurant::class, 'owner_id', 'id');
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function blocked_restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'restaurant_blocked_users', 'user_id', 'restaurant_id');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    
    public function getIsAdminAttribute(){
        return $this->hasRole(constants('ROLES.ADMIN'));
    }
    
    public function getIsOwnerAttribute(){
        return $this->hasRole(constants('ROLES.OWNER'));
    }
    
    public function getIsCustomerAttribute(){
        return $this->hasRole(constants('ROLES.CUSTOMER'));
    }
    
    public function getBlockedRestaurantIdsAttribute(){
        return $this->blocked_restaurants()->pluck('restaurant_id');
    }
}
