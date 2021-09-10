<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\InternalErrorException;
use App\Interfaces\IOrderService;
use Illuminate\Http\Request;
use Exception;
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
     * @param int $id
     * 
     * @throws InternalErrorException 
     * @throws ModelNotFoundException 
     * @return App\Models\Order $order
     */
    public function show($id)
    {
        try {
            return $this->order_service->getOrder($id);
        } catch (Exception $e) {
            if($e instanceof ModelNotFoundException) {
                Log::warning('Get an order by its id, ModelNotFoundException', ['error' => $e->getMessage()]);
                throw $e;
            }

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
     * @throws ModelNotFoundException 
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
            if($e instanceof ModelNotFoundException) {
                Log::warning('Update an order by its id, ModelNotFoundException', ['error' => $e->getMessage()]);
                throw $e;
            }

            Log::error('Update an order by its id, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }
}
