<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'food_type',
        'description',
        'is_active',
    ];
    
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }
    
    public function meals()
    {
        return $this->hasMany(Meal::class);
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    public function blocked_users()
    {
        return $this->belongsToMany(User::class, 'restaurant_blocked_users', 'restaurant_id', 'user_id');
    }
}
