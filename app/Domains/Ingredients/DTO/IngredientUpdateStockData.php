<?php

namespace App\Domains\Ingredients\DTO;

use App\Domains\Stock\Enums\StockableUnitOfMeasureEnums;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Attributes\Validation\Numeric;
use Spatie\LaravelData\Data;
use Symfony\Contracts\Service\Attribute\Required;

class IngredientUpdateStockData extends Data
{
    public function __construct(
        #[Numeric]
        public int    $quantity,
        #[Enum(StockableUnitOfMeasureEnums::class)]
        public string $unit_measure,
        #[Required]
        public bool   $is_countable
    )
    {
    }
}
