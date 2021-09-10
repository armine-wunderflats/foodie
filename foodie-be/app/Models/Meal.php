<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'restaurant_id',
    ];
    
    protected $casts = [
        'price' => 'float',
    ];
    
    public function restaurant()
    {
        return $this->hasOne(Restaurant::class);
    }
}
