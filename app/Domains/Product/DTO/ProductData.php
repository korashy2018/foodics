<?php

namespace App\Domains\Product\DTO;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Numeric;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class ProductData extends Data
{
    public function __construct(
        public string         $nameEn,
        public string         $nameAr,
        #[Numeric]
        public string         $price,
        #[DataCollectionOf(ProductIngredientData::class)]
        public DataCollection $ingredients,
    )
    {
    }
}
