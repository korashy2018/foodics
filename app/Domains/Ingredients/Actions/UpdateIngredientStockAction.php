<?php

namespace App\Domains\Ingredients\Actions;

use App\Domains\Ingredients\DTO\IngredientUpdateStockData;
use App\Domains\Ingredients\Models\Ingredient;

class UpdateIngredientStockAction
{
    public function __invoke(IngredientUpdateStockData $data, Ingredient $ingredient): Ingredient
    {
        $prepareToCreateOrUpdate = [
            'quantity' => $data->quantity,
            'unit_measure' => $data->unit_measure,
            'is_countable' => $data->is_countable
        ];
        $ingredient->stock()->updateOrCreate([], $prepareToCreateOrUpdate);
        return $ingredient->load('stock');
    }
}
