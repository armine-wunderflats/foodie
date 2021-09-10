<?php

namespace App\Http\Controllers;

use App\Exceptions\InternalErrorException;
use App\Interfaces\IMealService;
use Exception;
use Illuminate\Http\Request;
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
     * @param Illuminate\Http\Request $request
     * @param int $id
     * 
     * @throws InternalErrorException 
     * @return App\Models\Meal $meal
     */
    public function show(Request $request, $id)
    {
        try {
            return $this->meal_service->getMeal($id);
        } catch (Exception $e) {
            Log::error('Get meal by id, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }

    /**
     * Update a meal by its id.
     *
     * @param Illuminate\Http\Request $request
     * @param int $id
     * 
     * @throws InternalErrorException 
     * @return App\Models\Meal $meal
     */
    public function updateMeal(Request $request, $id)
    {
        try {
            $payload = $request->only([
                'name',
                'description',
                'price',
            ]);

            return $this->meal_service->update($id, $payload);
        } catch (Exception $e) {
            Log::error('Update a meal by its id, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }

    /**
     * Delete meal by id
     * 
     * @param Illuminate\Http\Request $request
     * @param int $id
     * 
     * @throws InternalErrorException 
     * @return void
     */
    public function deleteMeal(Request $request, $id)
    {
        try {
            $this->meal_service->delete($id);
        } catch (Exception $e) {
            Log::error('Delete meal by id, Exception', ['error' => $e->getMessage()]);
            throw new InternalErrorException();
        }
    }
}
