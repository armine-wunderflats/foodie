<?php

namespace App\Interfaces;

interface IMealService
{
    /**
     * Get the meal by its id.
     *
     * @param int $id
     *
     * @return App\Models\Meal $meal
     */
    public function getMeal($id);

    /**
     * Update a given meal
     * 
     * @param int $id
     * @param array $data
     * 
     * @return App\Models\Meal $meal
     */
    public function update($id, $data);

    /**
     * Delete a meal by its id
     * 
     * @param int $id
     * 
     * @return boolean
     */
    public function delete($id);
}
