<?php

namespace App\Domains\Ingredients\Actions;

use App\Domains\Ingredients\DTO\IngredientData;
use App\Domains\Ingredients\Models\Ingredient;

class UpdateIngredientAction
{
    public function __invoke(IngredientData $data, Ingredient $ingredient): Ingredient
    {
        $prepareForUpdate = [
            'name:en' => $data->nameEn,
            'name:ar' => $data->nameAr,
            'expiry_date' => $data->expiry_date
        ];
        $ingredient->update($prepareForUpdate);

        return $ingredient;

    }
}
