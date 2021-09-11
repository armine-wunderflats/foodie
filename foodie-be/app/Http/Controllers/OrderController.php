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
     * Get the orders for the current user
     * 
     * @param Illuminate\Http\Request $request
     * @throws InternalErrorException 
     * @return Collection $orders
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Order::class);

        try {
            return $this->order_service->getOrdersByUser($request->user());
        } catch (Exception $e) {
            Log::error('Get the orders for the current user, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
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
            $order = $this->order_service->getOrder($id);
        } catch (Exception $e) {
            if($e instanceof ModelNotFoundException) {
                Log::warning('Get an order by its id, ModelNotFoundException', ['error' => $e->getMessage()]);
                throw $e;
            }

            Log::error('Get order by id, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }

        $this->authorize('view', $order);

        return $order;
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
    public function update(Request $request, $id)
    {
        $this->authorize('update', $this->show($id));

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
