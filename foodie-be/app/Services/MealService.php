<?php

namespace App\Services;

use App\Interfaces\IMealService;
use App\Models\Meal;
use Log;

class MealService implements IMealService
{
    /**
     * {@inheritdoc}
     */
    public function getMeal($id)
    {
        Log::info('Getting meal by id', ['id' => $id]);
        return Meal::findOrFail($id);
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, $data)
    {
        Log::info('Updating meal', ['id' => $id]);
        $meal = $this->getMeal($id);
        $meal->update($data);
        
        return $meal;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        Log::info('Deleting meal', ['id' => $id]);
        $meal = $this->getMeal($id);
        return $meal->delete();
    }
}