<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const PLACED = 'Placed';
    const CANCELED = 'Canceled';
    const PROCESSING = 'Processing';
    const EN_ROUTE = 'En Route';
    const DELIVERED = 'Delivered';
    const RECEIVED = 'Received';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'status',
        'placed_on',
        'canceled_on',
        'processing_on',
        'en_route_on',
        'delivered_on',
        'received_on',
        'user_id',
        'restaurant_id',
    ];
    
    protected $appends = [
        'total_price',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    
    public function meals()
    {
        return $this->belongsToMany(Meal::class, 'order_meals', 'order_id', 'meal_id');
    }

    public function getTotalPriceAttribute()
    {
        return $this->meals->sum('price');
    }
}
