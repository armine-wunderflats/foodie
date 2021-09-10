<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\InternalErrorException;
use App\Http\Requests\UpdateMealRequest;
use App\Interfaces\IMealService;
use Exception;
use Log;

class MealController extends Controller
{
    private $meal_service;

    /**
     * Create a new MealService instance.
     *
     * @param IMealService $meal_service
     */
    public function __construct(IMealService $meal_service)
    {
        $this->meal_service = $meal_service;
    }

    /**
     * Get the meal by its id.
     *
     * @param int $id
     * 
     * @throws ModelNotFoundException 
     * @throws InternalErrorException 
     * @return App\Models\Meal $meal
     */
    public function show($id)
    {
        try {
            return $this->meal_service->getMeal($id);
        } catch (Exception $e) {
            if($e instanceof ModelNotFoundException) {
                Log::warning('Get a meal by its id, ModelNotFoundException', ['error' => $e->getMessage()]);
                throw $e;
            }

            Log::error('Get a meal by its id, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }

    /**
     * Update a meal by its id.
     *
     * @param App\Http\Requests\UpdateMealRequest $request
     * @param int $id
     * 
     * @throws InternalErrorException 
     * @throws ModelNotFoundException 
     * @return App\Models\Meal $meal
     */
    public function updateMeal(UpdateMealRequest $request, $id)
    {
        try {
            $payload = $request->only([
                'name',
                'description',
                'price',
            ]);

            return $this->meal_service->update($id, $payload);
        } catch (Exception $e) {
            if($e instanceof ModelNotFoundException) {
                Log::warning('Update a meal by its id, ModelNotFoundException', ['error' => $e->getMessage()]);
                throw $e;
            }

            Log::error('Update a meal by its id, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }

    /**
     * Delete meal by id
     * 
     * @param int $id
     * 
     * @throws InternalErrorException 
     * @throws ModelNotFoundException 
     * @return void
     */
    public function deleteMeal($id)
    {
        try {
            $this->meal_service->delete($id);
        } catch (Exception $e) {
            if($e instanceof ModelNotFoundException) {
                Log::warning('Delete a meal by its id, ModelNotFoundException', ['error' => $e->getMessage()]);
                throw $e;
            }

            Log::error('Delete a meal by its id, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }
}
