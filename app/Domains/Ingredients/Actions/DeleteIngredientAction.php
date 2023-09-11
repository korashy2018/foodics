<?php

namespace App\Domains\Ingredients\Actions;

use App\Domains\Ingredients\Models\Ingredient;

class DeleteIngredientAction
{
    public function __invoke(Ingredient $ingredient): bool
    {
        return $ingredient->delete();

    }
}
