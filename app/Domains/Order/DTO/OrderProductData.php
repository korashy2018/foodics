<?php

namespace App\Domains\Order\DTO;

use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Numeric;
use Spatie\LaravelData\Data;

class OrderProductData extends Data
{
    public function __construct(
        #[Exists('products')]
        public int $id,
        #[Numeric]
        public int $quantity
    )
    {
    }
}
