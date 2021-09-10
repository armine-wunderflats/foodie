<?php

namespace App\Http\Controllers;

use App\Exceptions\InternalErrorException;
use App\Interfaces\IOrderService;
use Exception;
use Illuminate\Http\Request;
use Log;

class OrderController extends Controller
{
    private $order_service;

    /**
     * Create a new OrderService instance.
     *
     * @param IOrderService $order_service
     */
    public function __construct(IOrderService $order_service)
    {
        $this->order_service = $order_service;
    }

    /**
     * Get the order by its id.
     *
     * @param Illuminate\Http\Request $request
     * @param int $id
     * 
     * @throws InternalErrorException 
     * @return App\Models\Order $order
     */
    public function show(Request $request, $id)
    {
        try {
            return $this->order_service->getOrder($id);
        } catch (Exception $e) {
            Log::error('Get order by id, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }

    /**
     * Update a order by its id.
     *
     * @param Illuminate\Http\Request $request
     * @param int $id
     * 
     * @throws InternalErrorException 
     * @return App\Models\Order $order
     */
    public function updateOrder(Request $request, $id)
    {
        try {
            $payload = $request->only([
                'status',
                'total_price',
                'placed_on',
                'canceled_on',
                'processing_on',
                'en_route_on',
                'delivered_on',
                'received_on',
            ]);

            return $this->order_service->update($id, $payload);
        } catch (Exception $e) {
            Log::error('Update a order by its id, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }
}
