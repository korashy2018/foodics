<?php

namespace App\Domains\Ingredients\Actions;

use App\Domains\Ingredients\DTO\IngredientUpdateStockData;
use App\Domains\Ingredients\Models\Ingredient;
use App\Domains\Stock\Enums\StockTransactionTypeEnums;

class CreateOrUpdateIngredientStockAction
{
    public function __invoke(IngredientUpdateStockData $data, Ingredient $ingredient): Ingredient
    {
        $prepareToCreate = [
            'quantity' => $data->quantity,
            'unit_measure' => $data->unit_measure,
            'is_countable' => $data->is_countable
        ];
        if ($ingredient->stock) {
            $ingredient->stock->quantity += $data->quantity;
            $ingredient->stock->save();
        } else {
            $ingredient->stock()->create($prepareToCreate);
            $ingredient->load('stock');

        }
        $ingredient->stock->transactions()->create([
            'type' => StockTransactionTypeEnums::PURCHASE,
            'quantity' => $data->quantity,
            'is_addition' => true,
        ]);

        return $ingredient;
    }
}
