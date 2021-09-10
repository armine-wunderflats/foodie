<?php

namespace App\Services;

use App\Interfaces\IOrderService;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\User;
use Log;

class OrderService implements IOrderService
{
    /**
     * {@inheritdoc}
     */
    public function getOrdersByUserId($id)
    {
        Log::info('Getting all orders by restaurant id');
        return User::findOrfail($id)->orders();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrdersByRestaurantId($id)
    {
        Log::info('Getting all orders by restaurant id');
        return Restaurant::findOrfail($id)->orders();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder($id)
    {
        Log::info('Getting order by id', ['id' => $id]);
        return Order::findOrFail($id);
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, $data)
    {
        Log::info('Updating order', ['id' => $id]);
        $order = $this->getOrder($id);
        $order->update($data);
        
        return $order;
    }
}