<?php

namespace App\Services;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use App\Interfaces\IOrderService;
use App\Models\Order;
use App\Models\Restaurant;
use Carbon\Carbon;
use Log;

class OrderService implements IOrderService
{
    /**
     * {@inheritdoc}
     */
    public function getOrdersByUser($user)
    {
        Log::info('Getting all orders by user');
        return $user->orders()->orderBy('created_at', 'desc')->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrdersByRestaurantId($id)
    {
        Log::info('Getting all orders by restaurant id');
        return Restaurant::findOrFail($id)->orders()->orderBy('created_at', 'desc')->get();
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

    /**
     * {@inheritdoc}
     */
    public function updateStatus($id, $user)
    {
        Log::info('Updating order status', ['id' => $id]);
        $order = $this->getOrder($id);
        $status = $order->status;
        $customerUpdate = $user->is_customer && ($status == ORDER::PLACED || $status == ORDER::DELIVERED);
        $ownerUpdate = $user->is_owner && ($status != ORDER::DELIVERED && $status != ORDER::CANCELED);

        if(!$customerUpdate && !$ownerUpdate) {
            throw new AccessDeniedHttpException('The user is not authorized to change the order status');
        }

        return $this->updateOrderStatus($status, $order, $customerUpdate);
    }

    private function updateOrderStatus($status, $order, $customerUpdate) {
        $now = Carbon::now();

        switch($status) {
            case ORDER::PLACED :
                if($customerUpdate) {
                    $order->status = ORDER::CANCELED;
                    $order->canceled_on = $now;
                } else {
                    $order->status = ORDER::PROCESSING;
                    $order->processing_on = $now;
                }
                break;
            case ORDER::PROCESSING :
                $order->status = ORDER::EN_ROUTE;
                $order->en_route_on = $now;
                break;
            case ORDER::EN_ROUTE :
                $order->status = ORDER::DELIVERED;
                $order->delivered_on = $now;
                break;
            case ORDER::DELIVERED :
                $order->status = ORDER::RECEIVED;
                $order->received_on = $now;
                break;
        }
        
        $order->save();
        return $order;
    }
}