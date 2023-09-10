<?php

namespace App\Domains\Stock\Enums;

enum StockTransactionTypeEnums: int
{
    case PURCHASE = 0;
    case WITHDRAW = 1;

    public function toString(): string
    {
        return match ($this) {
            self::PURCHASE => 'purchase',
            self::WITHDRAW => 'withdraw',
        };
    }

}
