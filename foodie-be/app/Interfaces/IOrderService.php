<?php

namespace App\Interfaces;

interface IOrderService
{
    /**
     * Get all orders.
     * 
     * @param int $id
     *
     * @return Collection $orders
     */
    public function getOrdersByRestaurantId($id);

    /**
     * Get all orders.
     * 
     * @param int $id
     *
     * @return Collection $orders
     */
    public function getOrdersByUserId($id);

    /**
     * Get the order by its id.
     *
     * @param int $id
     *
     * @return App\Models\Order $order
     */
    public function getOrder($id);

    /**
     * Update a given order
     * 
     * @param int $id
     * @param array $data
     * 
     * @return App\Models\Order $order
     */
    public function update($id, $data);
}
