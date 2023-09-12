<?php

namespace App\Domains\Order\DTO;

use App\Domains\Order\Enums\OrderStatusEnums;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class OrderData extends Data
{
    public function __construct(
        public ?int           $id,
        #[Date]
        #[DateFormat('Y/m/d')]
        public ?string        $order_date,
        #[Exists(table: 'users', column: 'id')]
        public int            $customer_id,
        #[Enum(OrderStatusEnums::class)]
        public ?int           $current_status,
        #[DataCollectionOf(OrderProductData::class)]
        public DataCollection $products
    )
    {
    }
}
