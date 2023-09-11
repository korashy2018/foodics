<?php

namespace App\Domains\Product\DTO;

use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;

class ProductIngredientData extends Data
{
    public function __construct(
        #[Exists(table: 'ingredients')]
        public int $id,
        public int $quantity_required
    )
    {
    }
}
