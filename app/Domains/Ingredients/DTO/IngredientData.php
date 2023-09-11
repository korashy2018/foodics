<?php

namespace App\Domains\Ingredients\DTO;

use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Spatie\LaravelData\Data;

class IngredientData extends Data
{
    public function __construct(
        public ?int   $id,
        #[Date]
        #[DateFormat('Y/m/d')]
        public string $expiry_date,
        public string $nameEn,
        public string $nameAr,
    )
    {
    }
}
