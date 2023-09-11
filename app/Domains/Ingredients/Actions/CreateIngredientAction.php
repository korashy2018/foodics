<?php

namespace App\Domains\Ingredients\Actions;

use App\Domains\Ingredients\DTO\IngredientData;
use App\Domains\Ingredients\Models\Ingredient;

class CreateIngredientAction
{
    public function __invoke(IngredientData $data): Ingredient
    {
        $prepareToCreate = [
            'name:en' => $data->nameEn,
            'name:ar' => $data->nameAr,
            'expiry_date' => $data->expiry_date
        ];
        $ingredient = Ingredient::create($prepareToCreate);

        return $ingredient;

    }
}
