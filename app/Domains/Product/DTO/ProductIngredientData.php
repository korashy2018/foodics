<?php

namespace App\Domains\Product\DTO;

use App\Domains\Ingredients\Enums\IngredientUnitOfMeasureEnums;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;

class ProductIngredientData extends Data
{
    public function __construct(
        #[Exists(table: 'ingredients')]
        public int    $id,
        public int    $quantity_required,
        #[Enum(IngredientUnitOfMeasureEnums::class)]
        public string $unit_measure

    )
    {
    }
}
